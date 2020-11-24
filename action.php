<?php
// insert catatan masuk
if (isset($_POST['add_in'])) {
    add_in();
}

function add_in()
{
    session_start();
    include 'connection.php';

    $desc = $_POST['desc'];
    $value = $_POST['value'];
    $category_id = $_POST['category_id'];
    $query = "INSERT INTO `logs` SET `desc`='$desc',value='$value',category_id='$category_id'";

    if (mysqli_query($connection, $query)) {
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Berhasil menambahkan catatan";
    } else {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "Gagal menambahkan catatan";
    }
    header('Location:' . $_SERVER['HTTP_REFERER']);
}

// insert catatan keluar
if (isset($_POST['add_out'])) {
    add_out();
}

function add_out()
{
    session_start();
    include 'connection.php';

    $desc = $_POST['desc'];
    $value = $_POST['value'];
    $category_id = $_POST['category_id'];
    $query = "INSERT INTO `logs` SET `desc`='$desc',value='$value',category_id='$category_id'";

    if (mysqli_query($connection, $query)) {
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Berhasil menambahkan catatan";
    } else {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "Gagal menambahkan catatan";
    }
    header('Location:' . $_SERVER['HTTP_REFERER']);
}

// delete category
if (isset($_GET['delete_category'])) {
    delete_category($_GET['delete_category']);
}

function delete_category($id)
{
    session_start();
    include 'connection.php';
    date_default_timezone_set("Asia/Jakarta");
    $time = date("Y-m-d h:i:sa");
    $query = "UPDATE categories SET `deleted_at`='$time' where id  = '$id'";

    if (mysqli_query($connection, $query)) {
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Berhasil menghapus kategori";
    } else {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "Gagal menghapus kategori";
    }
    header('Location:' . $_SERVER['HTTP_REFERER']);
}

// update kategori
if (isset($_POST['update_category'])) {
    update_category();
}

function update_category()
{
    session_start();
    include 'connection.php';

    $id = $_POST['category_id'];
    $name = $_POST['name'];
    $type = $_POST['category_type'];

    if ($id == 'new') {
        $query = "INSERT INTO categories (`name`,`type`) values ('$name','$type')";

        if (mysqli_query($connection, $query)) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Berhasil menambah kategori";
        } else {
            $_SESSION['status'] = "failed";
            $_SESSION['message'] = "Gagal menambah kategori";
        }
        header('Location:category.php');
    } else {
        $query = "UPDATE categories SET `name`='$name', type='$type' WHERE id = '$id'";

        if (mysqli_query($connection, $query)) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Berhasil memperbarui kategori";
        } else {
            $_SESSION['status'] = "failed";
            $_SESSION['message'] = "Gagal memperbarui kategori";
        }
        header('Location:category.php');
    }
}

// delete log
if (isset($_GET['delete_log'])) {
    delete_log($_GET['delete_log']);
}

function delete_log($id)
{
    session_start();
    include 'connection.php';
    date_default_timezone_set("Asia/Jakarta");
    $time = date("Y-m-d h:i:sa");
    $query = "UPDATE logs SET `deleted_at`='$time' where id  = '$id'";

    if (mysqli_query($connection, $query)) {
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Berhasil menghapus catatan";
    } else {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "Gagal menghapus catatan";
    }
    header('Location:' . $_SERVER['HTTP_REFERER']);
}

// update log
if (isset($_POST['update_log'])) {
    update_log();
}

function update_log()
{
    session_start();
    include 'connection.php';

    $id = $_POST['log_id'];
    $desc = $_POST['desc'];
    $value = $_POST['value'];
    $category_id = $_POST['category_id'];

    $query = "UPDATE logs SET `desc`='$desc', value='$value', category_id='$category_id' WHERE id = '$id'";
    if (mysqli_query($connection, $query)) {
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Berhasil memperbarui catatan";
    } else {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "Gagal memperbarui catatan";
    }
    header('Location:'.$_POST['from']);
}
