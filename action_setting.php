<?php
if (isset($_POST['update_username'])) {
    update_username();
}
if (isset($_POST['update_password'])) {
    update_password();
}

function update_username()
{
    session_start();
    include 'connection.php';

    $id = $_POST['id'];
    $username = $_POST['username'];

    $query = "UPDATE `user` SET `username`='$username' WHERE id = '$id'";
    if (mysqli_query($connection, $query)) {
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Berhasil memperbarui Username";
        $_SESSION['username'] = $username;
    } else {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "Gagal memperbarui Username";
    }
    header('Location:account_form.php');
}

function update_password()
{
    session_start();
    include 'connection.php';

    $id = $_POST['id'];
    $password = $_POST['password'];
    $new_pass = $_POST['new_pass'];
    $re_new_pass = $_POST['re_new_pass'];

    // validate new pass
    if ($new_pass != $re_new_pass) {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "New Password tidak sama dengan Re-type Password";
        header('Location:account_form.php');
        return;
    }

    // validate right pass
    $query = mysqli_query($connection, "SELECT * FROM `user` WHERE `id` = '$id'");
    if (mysqli_num_rows($query) > 0) {
        $row = $query->fetch_row();
        if (password_verify($password, $row[2])) {

            // generate new hash and save pass
            $hash_password = password_hash($new_pass, PASSWORD_DEFAULT);
            $query_update = "UPDATE `user` SET `password`='$hash_password' WHERE id='$id'";
            mysqli_query($connection, $query_update);

            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Berhasil memperbarui password";

        } else {
            $_SESSION['status'] = "failed";
            $_SESSION['message'] = "Password salah, Silahkan periksa kembali password anda";
        }
    } else {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "User tidak ditemukan";
    }

    header('Location:account_form.php');
}
