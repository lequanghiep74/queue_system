<?php
require "../include/DB.php";
session_start();
$db = new DB();
if (isset($_POST['username'])
    && isset($_POST['password'])
    && isset($_POST['type'])
) {
    $data = $db->queryOneRow("select *from " . $_POST['type'] . " where username = '" . $_POST['username'] . "'");
    if ($data->num_rows > 0) {
        $_SESSION['user'] = $data[0];
        header('', true, 200);
    } else {
        header(' ', true, 400);
    }
}
?>