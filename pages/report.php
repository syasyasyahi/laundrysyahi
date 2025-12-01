<?php
include "config/config.php";

$rows = [];
$total_income = 0;
$total_tax = 0;
$total_subtotal = 0;
$start_date = "";
$end_date = "";

if (isset($_GET['filter'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    $sd = DateTime::createFromFormat('Y-m-d', $start_date);
    $ed = DateTime::createFromFormat('Y-m-d', $end_date);

    // jika valid, format ulang dan jalankan query
    if ($sd && $ed) {
        $start = $sd->format('Y-m-d');
        $end = $ed->format('Y-m-d');

        // Query ambil data berdasarkan range tanggal
        // Kita ambil juga nama customer menggunakan JOIN

        // Query ambil data berdasarkan range tanggal (mengambil subtotal dari trans_order_details)
        $query_sql = "
            SELECT 
                tr.id AS order_id,
                tr.order_code,
                tr.order_end_date,
                c.name AS name,
                COALESCE(SUM(td.subtotal), 0) AS order_subtotal,
                COALESCE(tr.order_tax, 0) AS order_tax,
                COALESCE(tr.order_total, 0) AS order_total
            FROM trans_orders tr
            LEFT JOIN customers c ON c.id = tr.customer_id
            LEFT JOIN trans_order_details td ON td.order_id = tr.id
            WHERE DATE(tr.order_end_date) BETWEEN '$start' AND '$end'
            GROUP BY tr.id
            ORDER BY tr.order_end_date DESC
        ";

        $query = mysqli_query($config, $query_sql);

        if (!$query) {
            // Debug-friendly error 
            die("Query Error: " . mysqli_error($config));
        }

        $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

        // Hitung total pendapatan dari hasil filter
        foreach ($rows as $r) {
            $total_income += isset($r['order_total']) ? (float) $r['order_total'] : 0;
            $total_tax += isset($r['order_tax']) ? (float) $r['order_tax'] : 0;
            $total_subtotal += isset($r['order_subtotal']) ? (float) $r['order_subtotal'] : 0;
        }
    } else {
        $rows = [];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        .report-logo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 40%;
            /* BIKIN BULAT */
            margin-bottom: 5px;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            .card {
                border: none !important;
            }

            .report-logo {
                width: 120px;
                height: 120px;
            }
        }
    </style>

</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center mb-4">
                <img src="assets/uploads/logosyahis.png" alt="Logo Syahi's Laundry" class="report-logo"><br>
                <p class="mb-0">Jl. Karet Pasar Baru Barat, Karet Tengsin, Kecamatan Tanah Abang, Kota Jakarta Pusat,
                    Daerah Khusus
                    Ibukota Jakarta 10250</p>
                <p class="mt-0">(021) 57950913</p>
                <h3 class="mt-3 mb-1 fw-bold">Transaction Report</h3>
            </div>
            <div class="card-body">

                <form action="" method="GET" class="row g-3 mb-4 no-print border p-2 rounded bg-light">
                    <input type="hidden" name="page" value="report">
                    <div class="col-auto d-flex align-items-center">
                        <label class="col-form-label me-2">From:</label>
                        <input type="date" name="start_date" class="form-control" value="<?php echo $start_date ?>"
                            required>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <label class="col-form-label me-2">To:</label>
                        <input type="date" name="end_date" class="form-control" value="<?php echo $end_date ?>"
                            required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="filter" class="btn btn-primary">
                            <i class="bi bi-search"></i> Show Report
                        </button>
                        <?php if (isset($_GET['filter'])): ?>
                            <button type="button" onclick="window.print()" class="btn btn-success ms-1">
                                <i class="bi bi-printer"></i> Print Report
                            </button>
                        <?php endif; ?>
                        <a href="?page=report" class="btn btn-secondary no-print">Back</a>
                    </div>
                </form>

                <?php if (isset($_GET['filter']) && count($rows) > 0): ?>
                    <div class="alert alert-info">
                        Transaction Report From: <strong><?php echo date('d-m-Y', strtotime($start_date)) ?></strong> To
                        <strong><?php echo date('d-m-Y', strtotime($end_date)) ?></strong>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order Code</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th class="text-end">Order Subtotal</th>
                                <th class="text-end">Order Tax</th>
                                <th class="text-end">Order Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $key => $v): ?>
                                <tr>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><?php echo $v['order_code'] ?></td>
                                    <td><?php echo $v['order_end_date'] ?></td>
                                    <td><?php echo $v['name'] ?? 'Umum' ?></td>
                                    <td class="text-end">Rp. <?php echo number_format($v['order_subtotal'], 0, ',', '.') ?></td>
                                    <td class="text-end">Rp. <?php echo number_format($v['order_tax'], 0, ',', '.') ?></td>
                                    <td class="text-end">Rp. <?php echo number_format($v['order_total'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr class="table fw-bold">
                                <th colspan="4" class="text-center">Total</th>
                                <th class="text-end">Rp. <?php echo number_format($total_subtotal, 0, ',', '.') ?></th>
                                <th class="text-end">Rp. <?php echo number_format($total_tax, 0, ',', '.') ?></th>
                                <th class="text-end">Rp. <?php echo number_format($total_income, 0, ',', '.') ?></th>
                            </tr>
                        </tfoot>
                    </table>

                <?php elseif (isset($_GET['filter'])): ?>
                    <div class="text-center p-5 text-muted">
                        <i class="bi bi-inbox fs-1"></i>
                        <p>There Are No Transaction In Those Date</p>
                    </div>
                <?php else: ?>
                    <div class="text-center p-5 text-muted">
                        <i class="bi bi-calendar-check fs-1"></i>
                        <p>Please select the "From" and "To" dates to view the report</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>

</html>