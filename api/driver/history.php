<?php
require "../include/DB.php";
session_start();
$db = new DB();
$query = "select rq.id, tlc.name as to_location, b.plate_no, rq.start_time, rq.queue, rq.status "
    . "from route_queue rq "
    . "left join bus b on b.id = rq.bus_id "
    . "left join location tlc on tlc.id = rq.to_location_id "
    . "where driver_id = " . $_SESSION['user']['id'] . " "
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