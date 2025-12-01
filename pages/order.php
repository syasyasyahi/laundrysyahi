<?php
$query = mysqli_query($config, "SELECT c.name, `to`. * FROM trans_orders `to` LEFT JOIN customers c ON c.id = to.customer_id ORDER BY to.id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $service_photo = mysqli_query($config, "SELECT service_photo FROM services WHERE id = $id");
    $row = mysqli_fetch_assoc($service_photo);
    $filePath = $row['service_photo'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }
    $delete = mysqli_query($config, " DELETE FROM trans_orders WHERE id = $id");
    if ($delete) {
        header("location:?page=order");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Data Order</h3>
                    <div class="d-flex justify-content-end p-2">
                        <a href="pos/add-order.php" class="btn btn-primary">Add Order</a>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Order Code</th>
                            <th>Order End Date</th>
                            <th>Order Total</th>
                            <th>Order Tax</th>
                            <th>Order Pay</th>
                            <th>Order Change</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        foreach ($rows as $key => $v) {
                            ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $v['order_code'] ?></td>
                                <td><?php echo $v['order_end_date'] ?></td>
                                <td><?php echo $v['order_total'] ?></td>
                                <td><?php echo $v['order_tax'] ?></td>
                                <td><?php echo $v['order_pay'] ?></td>
                                <td><?php echo $v['order_change'] ?></td>
                                <td class="text-center status-badge">
                                    <?php
                                    $isPaid = ($v['order_pay'] >= $v['order_total']);
                                    if (!$isPaid) {
                                        echo '<span class="badge text-bg-danger fs-6">Not Paid</span>';
                                    } else {
                                        if ($v['order_status'] == 0) {
                                            echo '<span class="badge text-bg-warning fs-6">On Process</span>';
                                        } else {
                                            echo '<span class="badge text-bg-success fs-6">Ready for Pickup</span>';
                                        }
                                    }
                                    ?>
                                </td>

                                <td>
                                    <button class="btn btn-primary btn-sm" onclick="markReady(<?= $v['id'] ?>, this)">
                                      <i class="bi bi-calendar-check" ></i> Mark Ready
                                    </button>
                                    <a href="pos/print.php?id=<?php echo $v['id'] ?>" class="btn btn-success btn-sm">
                                        <i class="bi bi-printer"></i>
                                        Print</a>
                                    <a href="?page=order&delete=<?php echo $v['id'] ?>" class="btn btn-warning btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this order?')">
                                        <i class="bi bi-trash"></i>
                                        Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function markReady(orderId, button) {
            if (!confirm("Mark ready for pick up?")) return;

            let formData = new FormData();
            formData.append('id', orderId);

            fetch('pos/mark-ready-ajax.php', {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Ubah badge status langsung di halaman
                        let statusCell = button.closest('tr').querySelector('.status-badge');
                        statusCell.innerHTML = '<span class="badge text-bg-success fs-6">Ready for Pickup</span>';

                        // Hilangkan tombol tandai siap
                        button.remove();

                        alert("Status updated!");
                    } else {
                        alert("Failed to update status.");
                    }
                });
        }
    </script>

</body>

</html>