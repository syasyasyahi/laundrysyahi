<?php

//isset: tidak kosong
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM users WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['update'])) {
  //$_POST ambil simbol inputan
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = sha1($_POST['password']);


  // jika password diisi maka update password, jika tidak diisi maka password tidak diupdate
  if ($password) {
    $query = mysqli_query($config, "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id'");
  } else {
    $query = mysqli_query($config, "UPDATE users SET name='$name', email='$email' WHERE id='$id'");
  }
  if ($query) {
    header("location:?page=user&ubah=berhasil");
  }
}

if (isset($_POST['simpan'])) {
  //$_POST ambil simbol inputan
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = sha1($_POST['password']);

  $query = mysqli_query($config, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
  if ($query) {
    header("location:?page=user&add=berhasil");
  }
  ;
  if ($query) {
    header("location:?page=user&add=berhasil");
  }
}
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card p-4">
      <div class="card body">
        <h3 class="card-title">
          <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> User
        </h3>
        <form action="" method="post">
          <div class="mb-3">
            <label for="class=form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required
              value="<?php echo $rowEdit['name'] ?? '' ?>">
          </div>
          <div class="mb-3">
            <label for="class=form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required
              value="<?php echo $rowEdit['email'] ?? '' ?>">
          </div>
          <div class="form-group">
            <label for="class=form-label">Password * <small>Kosongkan jika tidak ingin mengubah</small></label>
            <input type="password" name="password" class="form-control" placeholder="Enter Your Password">
          </div>
          <br>
          <div class="form-group">
            <button class="btn btn-primary" type="submit" name="<?php echo ($id) ? 'update' : 'simpan' ?>">
              <?php echo isset($id) ? 'Save changes' : 'Simpan' ?>
            </button>
            <a href="?page=user" class="btn btn-secondary">Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>