
<?php
$user = isset($_SESSION['NAME']) ? $_SESSION['NAME'] : '';

$queryService = mysqli_query($config, 'SELECT COUNT(id) AS total_services FROM services');
$totalServices = mysqli_fetch_assoc($queryService)['total_services'];

$queryCustomer = mysqli_query($config, 'SELECT COUNT(id) AS total_customer FROM customers');
$totalCustomer = mysqli_fetch_assoc($queryCustomer)['total_customer'];

$queryTransaction = mysqli_query($config, 'SELECT COUNT(id) AS total_transaction FROM trans_orders');
$totalTransaction = mysqli_fetch_assoc($queryTransaction)['total_transaction'];

$queryIncome = mysqli_query($config, 'SELECT SUM(order_total) AS income FROM trans_orders');
$totalIncome = mysqli_fetch_assoc($queryIncome)['income'];
?>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Greeting Card (baris pertama) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Helo <?= $user ?>! 🧼</h5>
                            <p class="mb-4">Welcome To Syahi's Laundry!</p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <!-- 👋 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Aout Us -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="d-flex align-items-end row text">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary">About Us</h5>
                            <p class="mb-4">At Syahi’s Laundry, we believe clean clothes should spark joy, not stress! That’s why we offer a reliable service that makes laundry day feel effortless. From everyday wear to your favorite cozy blanket to cuddle up with your cat, we treat every item with care, using fresh-clean formulas and modern machines to bring back that just-washed happiness. Simple, quick, and always fun! That’s the Syahi’s Laundry way.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards (baris kedua) -->
    <div class="row d-flex align-items-stretch">
        <!-- Services -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-1000">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1 text-center">Services</span>
                    <h3 class="card-title mb-2 text-center"><?= $totalServices ?></h3>
                </div>
            </div>
        </div>

        <!-- Customer -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1 text-center">Customers</span>
                    <h3 class="card-title text-nowrap mb-2 text-center"><?= $totalCustomer ?></h3>
                </div>
            </div>
        </div>

        <!-- Income -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                        </div>
                    </div>
                    <span class="d-block fw-semibold mb-1 text-center">Income</span>
                    <h3 class="card-title text-nowrap mb-2 text-center">Rp <?= number_format($totalIncome, 0, ',', '.') ?></h3>
                </div>
            </div>
        </div>

        <!-- Transactions -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1 text-center">Total Transaction</span>
                    <h3 class="card-title mb-2 text-center"><?= $totalTransaction ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>