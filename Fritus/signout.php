<?php
    include 'db.php';
    session_start();
    if (isset($_SESSION['user'])){
        unset ($_SESSION['user']);
        unset ($_SESSION['pass']);
        header ('Location: login.php');
    }
?>