<?php
// include
// include_once
// require_once
// require
require_once 'config/config.php';

$query = mysqli_query($config, "SELECT * FROM customers u ORDER BY u.id DESC");
$customers = mysqli_fetch_all($query, MYSQLI_ASSOC);

// disini parameter delete
// $_GET
// isset, empty
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = mysqli_query($config, "DELETE FROM customers WHERE id = $id");

  // redirect
  header("location:?page=customer&hapus=berhasil");
}

?>

<div class="row">
  <div class="col-sm-12">

    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Data Customer</h3>
        <div class="mb-3" align="right">
          <a href="?page=tambah-customer" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>Add Customer
          </a>
        </div>
        <table class="table table-bordered table-striped datatable">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Address</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($customers as $key => $value): ?>
              <tr>
                <td><?php echo $key += 1 ?></td>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['phone'] ?></td>
                <td><?php echo $value['address'] ?></td>
                <td>
                  <a class="btn btn-success btn-sm" href="?page=tambah-customer&edit=<?php echo $value['id'] ?>">
                    <i class="bi bi-pencil"></i>
                  </a>|
                  <a class="btn btn-warning btn-sm" onclick="return confirm('Are you sure you want to delete this customer?')"
                    href="?page=customer&delete=<?php echo $value['id'] ?>">
                    <i class="bi bi-trash"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>