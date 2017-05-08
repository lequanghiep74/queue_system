<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['from_location_id'])
    && isset($_GET['to_location_id'])
    && isset($_GET['start_time'])
    && isset($_GET['bus_id'])
) {
    $query = "select rq.id, flc.name as from_location, tlc.name as to_location, b.plate_no, rq.start_time, rq.queue from route_queue rq "
        . "left join bus b on b.id = rq.bus_id "
        . "left join location flc on flc.id = rq.from_location_id "
        . "left join location tlc on tlc.id = rq.to_location_id "
        . "where status = 0 "
        . "and from_location_id = " . $_GET['from_location_id'] . " "
        . "and to_location_id = " . $_GET['to_location_id'] . " "
        . "and start_time = '" . $_GET['start_time'] . "' "
        . "and bus_id = " . $_GET['bus_id'];
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