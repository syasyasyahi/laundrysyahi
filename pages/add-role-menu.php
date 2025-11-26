<?php
$id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;

$level = [];
if ($id > 0) {
    $selectLevel = mysqli_query($config, "SELECT *  FROM levels WHERE id=$id");
    $level = mysqli_fetch_assoc($selectLevel);
}

$level_id = $level['id'];
$queryMenus = mysqli_query($config, "SELECT * FROM menus ORDER BY id DESC");
$rowMenus = mysqli_fetch_all($queryMenus, MYSQLI_ASSOC);

$selectedMenu = mysqli_query($config, "SELECT * FROM level_menus WHERE '$level_id='");
$selectedMenuIds = [];
$rowSelectedMenus = mysqli_fetch_all($selectedMenu, MYSQLI_ASSOC);
foreach ($rowSelectedMenus as $selectedMenus) {
    $selectedMenuIds [] = $selectedMenus['menu_id'];
}

if (isset($_POST['save'])) {
    $level_id = $_POST['level_id'];
    $menu_id = $_POST['menu_id'];

    mysqli_query($config, "DELETE FROM level_menus WHERE level_id ='$level_id'");
    foreach ($menu_id as $key => $menu) {
        $insert = mysqli_query($config, "INSERT INTO level_menus (menu_id, level_id) VALUES ('$menu', '$level_id')");
    }
    header("Location:?page=level&tambah=success");
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
                    <div class="card-body">
                        <h1 class="card-title"><?php echo isset($_GET['edit']) ? 'Update' : 'Tambah' ?> Level</h1>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="" class="form-label">level Name</label><br>
                                <input placeholder="Enter level name" type="text" name="level_name" class="form-control w-50"
                                    value="<?php echo $level['level_name'] ?? '' ?>" readonly>

                                <input type="hidden" name="level_id" value="<?php echo $level['id'] ?? '' ?>">
                            </div>
                            <div class="mb-3">
                                <?php foreach ($rowMenus as $menu): ?>
                                    <label for="" class="form-label">
                                        <input type="checkbox" name="menu_id[]" value="<?php echo $menu['id'] ?>"
                                        <?php echo in_array($menu['id'], $selectedMenuIds) ? 'checked' : '' ?>> <?php echo $menu['name'] ?>
                                    </label>
                                    <br>
                                <?php endforeach ?>
                            </div>
                            <button type="submit" class="btn btn-primary" name="save">Save Change</button>
                            <a href="?page=level" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>