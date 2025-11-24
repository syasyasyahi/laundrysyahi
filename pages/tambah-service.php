<?php
//services :
$id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;

$service = [];
if ($id > 0) {
  $service = mysqli_query($config, "SELECT * FROM services WHERE id = $id");
  $service = mysqli_fetch_assoc($service);
}

if (isset($_POST['simpan'])) {
  $service_name = $_POST['service_name'];
  $service_price = $_POST['service_price'];
  $service_description = $_POST['service_description'];
  $service_photo = $_FILES['service_photo'];

  $filePath = "assets/uploads/" . time() . "-" . $service_photo['name'];
  move_uploaded_file($service_photo['tmp_name'], $filePath);

  $insertService = mysqli_query($config, "INSERT INTO services (service_name, service_photo, service_price, service_description) VALUES ('$service_name','$filePath','$service_price','$service_description')");
  if ($insertService) {
    header("location:?page=service");
    exit;
  }
}

if (isset($_POST['update'])) {
  $service_name = $_POST['service_name'];
  $service_price = $_POST['service_price'];
  $service_description = $_POST['service_description'];
  $service_photo = $_FILES['service_photo'];
  //jika ada foto baru:
  $cek_foto = mysqli_query($config, "SELECT service_photo FROM services WHERE id = $id");
  $row = mysqli_fetch_assoc($cek_foto);
  $oldFile = $row['service_photo'];
  $filePath = $oldFile;
  if (!empty($service_photo['name'])) {
    $dir = "assets/uploads/";
    if (!is_dir($dir)) {
      mkdir($dir, 0777, true);
    }
    if (file_exists($oldFile)) {
      unlink($oldFile);
    }
    $filePath = "assets/uploads/" . time() . "-" . $service_photo['name'];
    move_uploaded_file($service_photo['tmp_name'], $filePath);
  }

  $update = mysqli_query($config, "UPDATE services SET service_name='$service_name', service_price='$service_price', service_description='$service_description', service_photo='$filePath' WHERE id = $id");
  if ($update) {
    header("location:?page=service");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Service</title>
</head>

<body>
  <div class="card">

    <div class="card-header">
      <h3 class="card-title">
        <?php echo $id > 0 ? "Edit Service" : "Add Service" ?>
      </h3>
    </div>

    <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
        <label for="" class="form-label">Service Name</label>
        <input class="form-control" type="text" name="service_name"
          value="<?php echo $service ? $service['service_name'] : '' ?>" required>
        <label for="" class="form-label">Photo</label><br>
        <?php if ($id > 0): ?>
          <img src="<?php echo $service['service_photo'] ?>" width='115' alt="">
        <?php endif; ?>
        <input class="form-control" type="file" name="service_photo">
        <label for="" class="form-label">Price</label>
        <input class="form-control" value="<?php echo $service ? intval($service['service_price']) : '' ?>"
          type="number" name="service_price" required>
        <label for="" class="form-label">Description</label>
        <textarea class="form-control" name="service_description" cols="30" rows="5"
          required><?php echo $service['service_description'] ?? '' ?></textarea>
        <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update' : "simpan" ?>"
          class="btn btn-primary mt-2"><?php echo isset($_GET['edit']) ? 'Edit' : 'ADD' ?></button>
      </form>
    </div>
  </div>
  </div>
</body>

</html>