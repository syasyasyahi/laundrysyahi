<?php

//isset: tidak kosong
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM users WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

$queryLevels = mysqli_query($config, "SELECT * FROM levels ORDER BY id DESC");
$rowLevels = mysqli_fetch_all($queryLevels, MYSQLI_ASSOC);

if (isset($_POST['update'])) {
  //$_POST ambil simbol inputan
  $level_id = $_POST['level_id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = sha1($_POST['password']);


  // jika password diisi maka update password, jika tidak diisi maka password tidak diupdate
  if ($_POST['password']) {
    $query = mysqli_query($config, "UPDATE users SET name='$name', email='$email', password='$password', level_id='$level_id' WHERE id='$id'");
  } else {
    $query = mysqli_query($config, "UPDATE users SET name='$name', email='$email', level_id='$level_id' WHERE id='$id'");
  }
  if ($query) {
    header("location:?page=user&ubah=berhasil");
  }
}

if (isset($_POST['simpan'])) {
  //$_POST ambil simbol inputan
  $level_id = $_POST['level_id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = sha1($_POST['password']);

  $query = mysqli_query($config, "INSERT INTO users (name, email, password, level_id) VALUES ('$name', '$email', '$password', '$level_id')");
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
      <h3 class="card-title">
        <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> User
      </h3>
      <form action="" method="post">
        <div class="mb-3">
          <label for="class=form-label">Level Name</label>
          <select name="level_id" id="" class="form-control">
            <option value="">choose One</option>
            <?php foreach ($rowLevels as $rowLevel): ?>
              <option value="<?php echo $rowLevel['id'] ?>"><?php echo $rowLevel['level_name'] ?></option>
            <?php endforeach ?>
          </select>
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
            <label for="class=form-label">Password * <small>Leave blank if you don't want to change</small></label>
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