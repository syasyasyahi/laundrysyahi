<?php

//isset: tidak kosong
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM customers WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['update'])) {
  //$_POST ambil simbol inputan
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  $query = mysqli_query($config, "
        UPDATE customers 
        SET name='$name', phone='$phone', address='$address' 
        WHERE id='$id'
    ");

  if ($query) {
    header("location:?page=customer&ubah=berhasil");
  }
}

if (isset($_POST['simpan'])) {
  //$_POST ambil simbol inputan
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  $query = mysqli_query($config, "INSERT INTO customers (name, phone, address) VALUES ('$name', '$phone', '$address')");
  if ($query) {
    header("location:?page=customer&add=berhasil");
  }
  ;
}
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card p-4">
      <div class="card body">
        <h3 class="card-title">
          <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> Customer
        </h3>
        <form action="" method="post">
          <div class="mb-3">
            <label for="class=form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your name" required
              value="<?php echo $rowEdit['name'] ?? '' ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter your phone number"
              value="<?php echo $rowEdit['phone'] ?? '' ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" placeholder="Enter your address"
              required><?php echo $rowEdit['address'] ?? '' ?></textarea>
          </div>
          <br>
          <div class="form-group">
            <button class="btn btn-primary" type="submit" name="<?php echo ($id) ? 'update' : 'simpan' ?>">
              <?php echo isset($id) ? 'Save changes' : 'Save' ?>
            </button>
            <a href="?page=customer" class="btn btn-secondary">Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>