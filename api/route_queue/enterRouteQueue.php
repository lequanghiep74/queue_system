<?php
require "../include/DB.php";
$db = new DB();
if (isset($_GET['id'])
    && isset($_GET['student_id'])
) {
    $query = "update route_queue set queue = queue + 1 where id = " . $_GET['id'];
    $queue_num = $db->query($query);
    $query = "insert into student_queue (student_id, queue, status, route_queue_id) values ("
        . $_GET['student_id'] . ", "
        . $queue_num . ", "
        . 0 . ", "
        . $_GET['id'] . ")";
    if ($db->query($query) == true) {
        header(' ', true, 200);
    } else {
        header(' ', true, 400);
    }
}
?>