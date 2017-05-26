<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['to_location_id'])
    && isset($_GET['bus_id'])
) {
    $query = "select *from route_queue "
        . "where status = 0 "
        . "and to_location_id = " . $_GET['to_location_id'];
    $data = $db->queryOneRow($query);
    if ($data != null) {
        header('Duplicate route queue', true, 400);
        echo 'Route is exists';
    } else {
        $query = "insert into route_queue (queue, status, "
            . "driver_id, accept, cancel, bus_id, start_time, to_location_id) "
            . "VALUES (" . 0 . ","
            . 0 . ","
            . $_SESSION['user']['id'] . ","
            . 0 . ","
            . 0 . ","
            . $_GET['bus_id'] . ","
            . "STR_TO_DATE('" . date("d-m-Y") . "', '%d-%m-%Y'),"
            . $_GET['to_location_id'] . ");";
        $id = $db->insertAndReturnId($query, 'route_queue')->fetch_assoc()['id'];
        if ($id != null) {
            header('ok', true, 200);
            echo '{"id": ' . $id . '}';
        } else {
            header('Error!!!', true, 400);
            echo 'Error!!!';
        }
    }
} else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>