<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['to_location_id'])
) {
    $query = "select rq.id, tlc.name as to_location, b.plate_no, rq.queue from route_queue rq "
        . "left join bus b on b.id = rq.bus_id "
        . "left join location tlc on tlc.id = rq.to_location_id "
        . "where status = 0 "
        . "and to_location_id = " . $_GET['to_location_id'];
    $data = $db->query($query);
    if ($data) {
        $datas = array();
        while ($row = $data->fetch_assoc()) {
            array_push($datas, $row);
        }
        if (count($datas) > 0) {
            header("", true, 200);
            echo json_encode($datas);
        } else {
            header("Not exist route for this location", true, 400);
            echo "Not exist route for this location";
        }
    } else {
        header("", true, 500);
    }
} else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>