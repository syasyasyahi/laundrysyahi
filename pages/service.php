<?php
$q_services = mysqli_query($config, "SELECT * FROM services ORDER BY id DESC");
$services = mysqli_fetch_all($q_services, MYSQLI_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $s_photo = mysqli_query($config, "SELECT service_photo FROM services WHERE id = $id");
    $row = mysqli_fetch_assoc($s_photo);
    $filePath = $row['service_photo'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }
    $delete = mysqli_query($config, " DELETE FROM services WHERE id = $id");
    if ($delete) {
        header("location:?page=service");
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
                <div class="card-header">
                    <h3 class="card title">Data Service</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end p-2">
                        <a href="?page=tambah-service" class="btn btn-primary">Add</a>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Service Name</th>
                            <th>Service Photo</th>
                            <th>Service Price</th>
                            <th>Service Description</th>
                        </tr>
                        <?php
                        foreach ($services as $key => $v) {
                            ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $v['service_name'] ?></td>
                                <td>
                                    <img src="<?php echo $v['service_photo'] ?>" width="115">
                                </td>
                                <td>Rp. <?php echo number_format($v['service_price'], 2, ',', '.') ?></td>
                                <td>
                                    <a href="?page=tambah-service&edit=<?php echo $v['id'] ?>"
                                        class="btn btn-success btn-sm">
                                        <i class="bi bi-pencil"></i>
                                        Edit</a>
                                    <a href="?page=service&delete=<?php echo $v['id'] ?>" class="btn btn-warning btn-sm"
                                        onclick="return confirm('ingin delete?')">
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
</body>

</html>