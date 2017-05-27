<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['report_date'])
) {
    $query = "select sum(accept) as accept, sum(cancel) as cancel, sum(total) as total "
        . "from route_queue "
        . "where DATE_FORMAT(start_time, '%d/%m/%Y') = '" . $_GET['report_date'] . "' and status > 0;";
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