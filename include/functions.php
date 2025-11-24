<?php 

// it : ada / tidak kosong
// !isset: kosong
// jika session kosong
function checklogin()
{
    if(!isset($_SESSION['ID'])){
        header("location:index.php?access=failed");
    }
}