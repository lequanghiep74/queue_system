<?php
require "../include/DB.php";
session_start();
$db = new DB();
if (isset($_GET['id'])
    && isset($_GET['status'])
) {
    $query = "";
    if ($_GET['status'] == 1) {
        $query = "update route_queue set status = " . $_GET['status'] . " where id = " . $_GET['id'];
        echo $query;
    } else {
        $query = "update route_queue set status = " . $_GET['status'] . ", cancel = cancel + accept, accept = 0 where id = " . $_GET['id'];
        echo $query;
    }
    if ($db->query($query)) {
        $query = '';
        if ($_GET['status'] == 1) {
            $query = "update student_queue set status = 2 where route_queue_id = " . $_GET['id'] . " "
                . "and status = 0";
        } else {
            $query = "update student_queue set status = 2 where route_queue_id = " . $_GET['id'];
        }
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