<?php
require "../include/DB.php";
session_start();
$db = new DB();
$query = "select sq.id, sq.status, sq.route_queue_id, rq.queue, flc.name as from_location, tlc.name as to_location, b.plate_no, rq.start_time "
    . "from student_queue sq "
    . "inner join route_queue rq on rq.id = sq.route_queue_id "
    . "inner join location flc on flc.id = rq.from_location_id "
    . "inner join location tlc on tlc.id = rq.to_location_id "
    . "inner join bus b on b.id = rq.bus_id "
    . "where student_id = " . $_SESSION['user']['id'];
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