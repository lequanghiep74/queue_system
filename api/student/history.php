<?php
require "../include/DB.php";
session_start();
$db = new DB();
$query = "select sq.id, sq.status, sq.route_queue_id, sq.queue, tlc.name as to_location, b.plate_no, rq.start_time, rq.id as route_id "
    . "from student_queue sq "
    . "left join route_queue rq on rq.id = sq.route_queue_id "
    . "left join location tlc on tlc.id = rq.to_location_id "
    . "left join bus b on b.id = rq.bus_id "
    . "where student_id = " . $_SESSION['user']['id'] . " "
    . "order by id desc";
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
?>