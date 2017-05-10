<?php
require "../include/DB.php";
session_start();
$db = new DB();
if (isset($_GET['route_queue_id'])
) {
    $query = "update route_queue set queue = queue + 1 where id = " . $_GET['route_queue_id'];
    $db->query($query);
    $query = "select queue from route_queue";
    $data = $db->query($query);
    while ($row = $data->fetch_assoc()) {
        $queue_num = $row['queue'];
    }

    $query = "insert into student_queue (student_id, queue, status, route_queue_id) values ("
        . $_SESSION['user']['id'] . ", "
        . $queue_num . ", "
        . 0 . ", "
        . $_GET['route_queue_id'] . ")";
    if ($db->query($query) == true) {
        header(' ', true, 200);
    } else {
        header(' ', true, 400);
    }
} else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>