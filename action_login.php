<?php
include 'connection.php';
require_once 'libs/string.php';
session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$query = mysqli_query($connection, "SELECT * FROM `user` WHERE username = '$username'");
if (mysqli_num_rows($query) > 0) {
    /* 
        validate password
        generate random string for session
        update db session
    */
    $row = $query->fetch_row();
    if (password_verify($password, $row[2])) {
        $sess = generateRandomString(50);
        $query_update = "UPDATE `user` SET `session`='$sess' WHERE id=$row[0]";
        mysqli_query($connection, $query_update);
        $_SESSION['username'] = $username;
        $_SESSION['login'] = "success";
        $_SESSION['session'] = $sess;
    }
} else {
    $_SESSION['login'] = "failed";
    $_SESSION['message'] = "Login GAGAL, Silahkan periksa kembali username dan password anda";
}

header('Location:' . $_SERVER['HTTP_REFERER']);
