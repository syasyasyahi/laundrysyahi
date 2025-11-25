<?php

//isset: tidak kosong
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM menus WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['update'])) {
  //$_POST ambil simbol inputan
  $name = $_POST['name'];
  $icon = $_POST['icon'];
  $link = $_POST['link'];
  $order = $_POST['order'];


  // jika link diisi maka update link, jika tidak diisi maka link tidak diupdate
  if ($link) {
    $query = mysqli_query($config, "UPDATE menus SET name='$name', icon='$icon', link='$link', `order`='$order' WHERE id='$id'");
  } else {
    $query = mysqli_query($config, "UPDATE menus SET name='$name', icon='$icon', link='$link', `order`='$order' WHERE id='$id'");
  }
  if ($query) {
    header("location:?page=menu&ubah=berhasil");
  }
}

if (isset($_POST['simpan'])) {
  //$_POST ambil simbol inputan
  $name = $_POST['name'];
  $icon = $_POST['icon'];
  $link = $_POST['link'];
  $order = $_POST['order'];

  $query = mysqli_query($config, "INSERT INTO menus (name, icon, link, `order`) VALUES ('$name', '$icon', '$link', '$order')");
  if ($query) {
    header("location:?page=menu&add=berhasil");
  }
  ;
  if ($query) {
    header("location:?page=menu&add=berhasil");
  }
}
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card p-4">

      <h3 class="card-title">
        <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> menu
      </h3>
      <form action="" method="post">
        <div class="mb-3">
          <label for="class=form-label">Name</label>
          <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required
            value="<?php echo $rowEdit['name'] ?? '' ?>">
        </div>
        <div class="mb-3">
          <label for="class=form-label">Icon</label>
          <input type="icon" name="icon" class="form-control" placeholder="Enter Your icon" required
            value="<?php echo $rowEdit['icon'] ?? '' ?>">
        </div>
        <div class="form-group">
          <label for="class=form-label">Link</label>
          <input type="text" name="link" class="form-control" placeholder="Enter Your link">
        </div>
        <br>
        <div class="form-group">
          <label for="class=form-label">Order</label>
          <input type="text" name="order" class="form-control" placeholder="Enter Your Order">
        </div>
        <br>
        <div class="form-group">
          <button class="btn btn-primary" type="submit" name="<?php echo ($id) ? 'update' : 'simpan' ?>">
            <?php echo isset($id) ? 'Save changes' : 'Simpan' ?>
          </button>
          <a href="?page=menu" class="btn btn-secondary">Back</a>
        </div>
      </form>

    </div>
  </div>
</div>