<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_POST['id'])
) {
    $query = "delete from location where id = " . $_POST['id'];
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