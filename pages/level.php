<?php

$query = mysqli_query($config, "SELECT * FROM levels");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
// var_dump($level)

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $q_delete = mysqli_query($config, "DELETE FROM levels WHERE id='$id'");
  header("location:?page=level");
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
        <div class="card-body">
          <h3 class="card-title">Data Level</h3>
            <div class="d-flex justify-content-end m-2">
              <a href="?page=tambah-level" class="btn btn-primary bi bi-plus-circle"> Add Level</a>
            </div>
            <table class="table table-bordered">
              <tr>
                <th>No</th>
                <th>Level Name</th>
                <th>Actions</th>
              </tr>
              <?php foreach ($rows as $key => $level): ?>
                <tr>
                  <td><?Php echo $key + 1 ?></td>
                  <td><?Php echo $level['level_name'] ?></td>
                  <td>
                    <a href="?page=add-role-menu&edit=<?php echo $level['id'] ?>" class="btn btn-warning"><i
                    class="bi bi-plus"></i>
                  </a>
                  <a href="?page=tambah-level&edit=<?php echo $level['id'] ?>" class="btn btn-success"><i
                  class="bi bi-pencil"></i>
                </a>
                <form class="d-inline" action="?page=level&delete=<?php echo $level['id'] ?>" method="post"
                onclick="return confirm('Are you sure you want to delete this level?')">
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
    </div>
  </div>
</div>
</body>

</html>