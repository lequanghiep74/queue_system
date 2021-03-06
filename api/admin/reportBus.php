<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['report_date'])
) {
    $query = "select b.bus_no, b.plate_no, sum(rq.queue) as queue, count(*) as count, sum(rq.accept) as accept, sum(rq.total) as total "
        . "from route_queue rq "
        . "inner join bus b on b.id = rq.bus_id "
        . "inner join location lc on lc.id = rq.to_location_id "
        . "where DATE_FORMAT(start_time, '%d/%m/%Y') = '" . $_GET['report_date'] . "' "
        . "group by rq.bus_id";
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