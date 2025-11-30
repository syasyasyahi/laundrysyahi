<?php
header('Content-Type: application/json');
include dirname(__DIR__) . '/config/config.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id <= 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid id']);
    exit;
}

// jalankan update
$sql = "UPDATE trans_orders SET order_status = 1 WHERE id = '$id'";

$result = mysqli_query($config, $sql);

if ($result) {
    echo json_encode(['success' => true]);
} else {
    // kembalikan error SQL agar kita tahu kenapa gagal
    $err = mysqli_error($config);
    echo json_encode(['success' => false, 'error' => $err, 'sql' => $sql]);
}
