<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_POST['from_location_id'])
    && isset($_POST['to_location_id'])
    && isset($_POST['start_time'])
    && isset($_POST['bus_id'])
) {
    $query = "select *from route_queue "
        . "where bus_id = " . $_POST['bus_id'] . " "
        . "and status = 0 "
        . "and from_location_id = " . $_POST['from_location_id'] . " "
        . "and to_location_id = " . $_POST['to_location_id'] . " "
        . "and start_time = '" . $_POST['start_time'] . "'";
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
            . "'" . $_POST['start_time'] . "',"
            . $_POST['bus_id'] . ","
            . $_POST['from_location_id'] . ","
            . $_POST['to_location_id'] . ");";
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