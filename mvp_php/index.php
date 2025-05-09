<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

include("view/CRUD.php");

$view = new CRUD();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $view->edit($_POST);
    } else {
        $view->tambah($_POST);
    }
    header("Location: index.php");
    exit();
}

if (isset($_GET['form'])) {
    if ($_GET['form'] == 'tambah') {
        $view->tampilForm('tambah');
    } elseif ($_GET['form'] == 'edit' && isset($_GET['id'])) {
        $view->tampilForm('edit', $_GET['id']);
    }
} elseif (isset($_GET['hapus']) && !empty($_GET['hapus'])) {
    $view->hapus($_GET['hapus']);
    header("Location: index.php");
    exit();
} else {
    $view->tampil();
}
?>