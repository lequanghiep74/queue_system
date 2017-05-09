<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['id'])
) {
    $query = "select student_queue.id, queue, student.fullname from student_queue "
        . "left join student on student.id = student_queue.student_id "
        . "where route_queue_id = " . $_GET['id'] . " "
        . "and status = 0 "
        . "order by queue "
        . "limit 1";
    $data = $db->query($query);
    if ($data) {
        $datas = array();
        while ($row = $data->fetch_assoc()) {
            array_push($datas, $row);
        }
        header("", true, 200);
        echo json_encode($datas);
    } else {
        header("", true, 500);
    }
} else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>