<?php
require "../include/DB.php";
session_start();
$db = new DB();
if (isset($_POST['username'])
    && isset($_POST['password'])
    && isset($_POST['type'])
) {
    $data = $db->queryOneRow("select *from " . $_POST['type'] . " where username = '" . $_POST['username'] . "'");
    if ($data != null) {
        $_SESSION['user'] = $data;
        header($_SESSION['user'], true, 200);
        echo 'Login success';
    } else {
        header('Username or password is invalid', true, 400);
        echo 'Username or password is invalid';
    }
}
else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>