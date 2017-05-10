<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['id'])
    && isset($_GET['bus_no'])
    && isset($_GET['plate_no'])
) {
    $query = "update bus set bus_no = '" . $_GET['bus_no'] . "', plate_no = '" . $_GET['plate_no'] . "' "
        . "where id = " . $_GET['id'];
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