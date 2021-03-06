<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['report_date'])
) {
    $query = "select d.fullname, sum(rq.bus_id) as bus, sum(rq.total) as total "
        . "from route_queue rq "
        . "inner join driver d on d.id = rq.driver_id "
        . "where DATE_FORMAT(start_time, '%d/%m/%Y') = '" . $_GET['report_date'] . "' "
        . "group by rq.driver_id";
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