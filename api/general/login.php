<?php
require "../include/DB.php";
session_start();
$db = new DB();
if (isset($_GET['username'])
    && isset($_GET['password'])
    && isset($_GET['type'])
) {
    $query = "select *from " . $_GET['type'] . " where username = '" . $_GET['username'] . "' and password ='" . $_GET['password'] . "'";
    $data = $db->queryOneRow($query);
    if ($data != null) {
        $_SESSION['user'] = $data;
        header(json_encode($_SESSION['user']), true, 200);
        echo json_encode($_SESSION['user']);
    } else {
        header('Username or password is invalid', true, 400);
        echo 'Username or password is invalid';
    }
} else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>