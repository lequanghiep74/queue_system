<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_POST['id'])
    && isset($_POST['bus_no'])
    && isset($_POST['plate_no'])
) {
    $query = "update bus set bus_no = '" . $_POST['bus_no'] . "', plate_no = '" . $_POST['plate_no'] . "' "
        . "where id = " . $_POST['id'];
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