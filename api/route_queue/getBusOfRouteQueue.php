<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['from_location_id'])
    && isset($_GET['to_location_id'])
    && isset($_GET['start_time'])
) {
    $query = "select b.id, b.plate_no from route_queue "
        . "left join bus b on b.id = route_queue.bus_id "
        . "where status = 0 "
        . "and from_location_id = " . $_GET['from_location_id'] . " "
        . "and to_location_id = " . $_GET['to_location_id'] . " "
        . "and start_time = '" . $_GET['start_time'] . "'";
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