<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_POST['name'])
) {
    $query = "insert into location (name) VALUES ('" . $_POST['name'] . "')";
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