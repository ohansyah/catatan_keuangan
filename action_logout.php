<?php
    session_start();
    $_SESSION['username'] = '';
    $_SESSION['login'] = '';
    $_SESSION['message'] = '';
    $_SESSION['session'] = '';
    unset($_SESSION['username']);
    unset($_SESSION['login']);
    unset($_SESSION['message']);
    unset($_SESSION['session']);
    session_unset();
    session_destroy();
    header("Location: index.php");
?>