<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['from_location_id'])
    && isset($_GET['to_location_id'])
    && isset($_GET['start_time'])
    && isset($_GET['bus_id'])
) {
    $query = "select *from route_queue "
        . "where bus_id = " . $_GET['bus_id'] . " "
        . "and status = 0 "
        . "and from_location_id = " . $_GET['from_location_id'] . " "
        . "and to_location_id = " . $_GET['to_location_id'] . " "
        . "and start_time = '" . $_GET['start_time'] . "'";
    $data = $db->queryOneRow($query);
    if ($data != null) {
        header('Duplicate route queue', true, 400);
        echo 'Route is exists';
    } else {
        $query = "insert into route_queue (queue, status, "
            . "driver_id, accept, cancel, start_time, bus_id, from_location_id, to_location_id) "
            . "VALUES (" . 0 . ","
            . 0 . ","
            . $_SESSION['user']['id'] . ","
            . 0 . ","
            . 0 . ","
            . "'" . $_GET['start_time'] . "',"
            . $_GET['bus_id'] . ","
            . $_GET['from_location_id'] . ","
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