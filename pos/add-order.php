<?php
date_default_timezone_set("Asia/Bangkok");
include '../config/config.php';

$queryCat = mysqli_query($config, "SELECT * FROM services");
$fetchCats = mysqli_fetch_all($queryCat, MYSQLI_ASSOC);

// query Product
// $queryProducts = mysqli_query($config, "SELECT s.service_name, p.* FROM products p LEFT JOIN services c ON c.id = p.category_id");
// $fetchProducts = mysqli_fetch_all($queryProducts, MYSQLI_ASSOC);

if (isset($_GET['payment'])) {

    // transaction
    mysqli_begin_transaction($config);
    $data = json_decode(file_get_contents('php://input'), true);
    $cart = $data["cart"];
    $total = array_reduce($cart, function ($sum, $item) {
        return $sum + ($item['service_price'] * $item['quantity']);
    }, 0);

    // Penting untuk ditanyakan ke customer : format tanggal dan running number
    $tax = $data['tax'];
    $orderAmounth = $data['grandTotal'];
    $orderCode = $data['order_code'];
    $orderDate = date("Y-m-d H:i:s");
    $trans_orderstatus = 1;
    $trans_ordersubtotal = $data['subtotal'];
    $orderChange = 0;

    try {
        $insertOrder = mysqli_query($config, "INSERT INTO trans_orders (order_code, order_date, order_amount, order_subtotal, order_change, order_status) VALUES ('$orderCode', '$orderDate', '$orderAmounth', '$trans_ordersubtotal', '$orderChange', '$trans_orderstatus')");
        $idOrder = mysqli_insert_id($config);

        if (!$insertOrder) {
            throw new Exception("Insert failed to table trans_orders", mysqli_error($config));
        }

        foreach ($cart as $v) {
            $product_id = $v['id'];
            $qty = $v['quantity'];
            $order_price = $v['product_price'];
            $subtotal = $qty * $order_price;

            $insertOrderDetails = mysqli_query($config, "INSERT INTO trans_order_details (order_id, product_id, qty, order_price, order_subtotal) VALUES ('$idOrder','$product_id', '$qty', '$order_price', '$subtotal')");
            if (!$insertOrderDetails) {
                throw new Exception("Insert failed to table order details", mysqli_error($config));
            }
        }

        mysqli_commit($config);
        $response = [
            'status' => 'Success',
            'message' => 'Transaction Success',
            'order_id' => $idOrder,
            'order_code' => $orderCode,
        ];
        echo json_encode($response, 201);
        die;
    } catch (\Throwable $th) {
        mysqli_rollback($config);
        $response = ['status' => 'Error', 'Message' => $th->getMessage()];
        echo json_encode($response);
        die;
        // ['status': '', 'message': ''];
    }

}

$orderNumbers = mysqli_query($config, "SELECT id FROM trans_orders ORDER BY id DESC LIMIT 1");
$row = mysqli_fetch_assoc($orderNumbers);
$nextId = $row ? $row['id'] + 1 : 1;
$order_code = "ORD-" . date('dmY') . str_pad($nextId, 3, "0", STR_PAD_LEFT);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syahi's Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/syahi.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fluid container-pos">
        <div id="card">
            <div class="row h-100">
                <div class="col-md-7 product-section">
                    <div class="mb-4">
                        <h4 class="mb-3" id="product-title">
                            <i class="fas fa-store"></i>
                            Service
                        </h4>
                        <input type="text" id="searchProduct" class="form-control search-box"
                            placeholder="Find Product...">
                    </div>

                    <div class="row" id="productGrid">
                    </div>
                </div>
                <div class="col-md-5 cart-section">
                    <div class="cart-header">
                        <h4>Basket</h4>
                        <!-- ORD-date-001 -->
                        <small>Order # <span class="orderNumber"><?php echo $order_code ?></span></small>
                    </div>
                    <div class="cart-items" id="cartItems">
                        <div class="text-center text-muted mt-5">
                            <i class="bi bi-basket-fill mb-3"></i>
                            <p>Your Basket Is Empty</p>
                        </div>
                    </div>

                    <div class="cart-footer">
                        <div class="total-section">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal :</span>
                                <span id="subtotal">Rp. 0.0</span>
                                <input type="hidden" id="subtotal_value">
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Pajak (10%) :</span>
                                <span id="tax">Rp. 0.0</span>
                                <input type="hidden" id="tax_value">
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total :</span>
                                <span id="total">Rp. 0.0</span>
                                <input type="hidden" id="total_value">
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <button class="btn btn-outline-danger w-100" id="clearCart">
                                <i class="bi bi-trash3-fill"></i> Clear Cart
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-checkout btn-primary w-100" onclick="processPayment()">
                                <i class="bi bi-cash-coin"></i> Process Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script>
        const products = <?php echo json_encode($fetchProducts); ?>
    </script>
    <script src="../assets//js/syahi.js"></script>
</body>

</html>