<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['id'])
    && isset($_GET['name'])
) {
    $query = "update location set name = '" . $_GET['name'] . "' where id = " . $_GET['id'];
    if ($db->query($query)) {
        header('ok', true, 200);
    } else {
        header('Error!!!', true, 400);
    }
} else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>