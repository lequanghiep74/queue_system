<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['bus_no'])
    && isset($_GET['plate_no'])
) {
    $query = "insert into bus (bus_no, plate_no) VALUES ('" . $_GET['bus_no'] . "','" . $_GET['plate_no'] . "')";
    echo $query;
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