<?php
$id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;

$level = [];
if ($id > 0) {
  $selectLevel = mysqli_query($config, "SELECT level_name FROM levels WHERE id=$id");
  $level = mysqli_fetch_assoc($selectLevel);
}
//var_dump($level);

if (isset($_POST['simpan'])) {
  $level_name = $_POST['level_name'];
  $insert = mysqli_query($config, "INSERT INTO levels (level_name) VALUES ('$level_name')");
  header("location:?page=level");
  exit;
}
if (isset($_POST['update'])) {
  $level_name = $_POST['level_name'];
  $update = mysqli_query($config, "UPDATE levels SET level_name='$level_name' WHERE id='$id'");

  header('location:?page=level');
  exit;
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
          <h13 class="card-title"><?php echo isset($_GET['edit']) ? 'Update' : 'Tambah' ?> Level</h3>
            <div class="card-body">
              <form action="" method="post">
                <div class="mb-3">
                  <label for="" class="form-label">level Name</label><br>
                  <input type="text" class="form-control w-50" name="level_name"
                    value="<?php echo $level['level_name'] ?? '' ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"
                  name="<?php echo isset($_GET['edit']) ? 'update' : 'simpan' ?>"><?php echo isset($id) ? 'Add' : 'Create' ?></button>
              </form>

            </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>