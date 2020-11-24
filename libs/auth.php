<?php
function ValidateLogin()
{
    include './connection.php';
    if (!(isset($_SESSION['session'])) || !(isset($_SESSION['username']))){
        include './action_logout.php';
        return;
    }

    $username = $_SESSION['username'];
    $session = $_SESSION['session'];
    $query = mysqli_query($connection, "SELECT * FROM `user` WHERE username = '$username' AND `session` = '$session'");
    if (mysqli_num_rows($query) < 1) {
        include './action_logout.php';
        return;
    }
}
