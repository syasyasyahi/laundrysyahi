<?php
//taxs :
$id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;

$tax = [];
$rowEdit = null;
if ($id > 0) {
    $query = mysqli_query($config, "SELECT * FROM taxs WHERE id = $id");
    $rowEdit = mysqli_fetch_assoc($query);
}

if (isset($_POST['simpan'])) {
    $percent = $_POST['percent'];
    $is_active = $_POST['is_active'];

    $insert = mysqli_query($config, "INSERT INTO taxs (percent, is_active) VALUES ('$percent','$is_active')");
    if ($insert) {
        header("location:?page=tax");
        exit;
    }
}

if (isset($_POST['update'])) {
    $ide = $_GET['edit'];
    $percent = $_POST['percent'];
    $is_active = $_POST['is_active'];

    $update = mysqli_query($config, "UPDATE taxs SET percent='$percent', is_active='$is_active' WHERE id = $id");
    if (!$update) {
        echo mysqli_error($config);
        exit;
    }

    header("location:?page=tax");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tax</title>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">
                <?php echo $id > 0 ? "Edit" : "Create" ?> Tax
            </h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="" class="form-label">Tax Percent</label>
                    <input class="form-control" type="number" name="percent"
                        value="<?php echo $rowEdit ? $rowEdit['percent'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Is Active</label>
                    <br>
                    <input type="radio" name="is_active" <?php echo $rowEdit ? $rowEdit ['is_active'] == 0 ? 'checked' : '' : '' ?>
                        value="0"> Draft
                    <br>
                    <input type="radio" name="is_active" <?php echo $rowEdit ? $rowEdit ['is_active'] == 1 ? 'checked' : '' : '' ?>
                        value="1"> Active
                </div>

                <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update' : "simpan" ?>"
                    class="btn btn-primary mt-2"><?php echo isset($_GET['edit']) ? 'Edit' : 'ADD' ?></button>
            </form>
        </div>
    </div>
    </div>
</body>

</html>