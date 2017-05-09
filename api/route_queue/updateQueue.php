<?php
require "../include/DB.php";
session_start();
$db = new DB();
if (isset($_GET['id'])
    && isset($_GET['status'])
) {
    $query = "update route_queue set status = " . $_GET['status'] . " where id = " . $_GET['id'];
    if ($db->query($query)) {
        $query = "update student_queue set status = 2 where route_queue_id = " . $_GET['id'] . " "
            . "and status = 0";
        if ($db->query($query)) {
            header(' ', true, 200);
        } else {
            header(' ', true, 400);
        }
    } else {
        header(' ', true, 400);
    }
} else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>