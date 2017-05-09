<?php
require "../include/DB.php";
session_start();
$db = new DB();
if (isset($_GET['id'])
    && isset($_GET['route_queue_id'])
    && isset($_GET['status'])
) {
    $query = "update student_queue set status = " . $_GET['status'] . " where id = " . $_GET['id'];
    if ($db->query($query)) {
        $prop = $_GET['status'] == '1' ? 'accept' : 'cancel';
        $query = "update route_queue set " . $prop . " = " . $prop . " + 1 where id = " . $_GET['route_queue_id'];
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