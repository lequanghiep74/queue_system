<?php
require "../include/DB.php";
$db = new DB();
if (isset($_POST['route_id'])
    && isset($_POST['driver_id'])
    && isset($_POST['accept'])
    && isset($_POST['cancel'])
    && isset($_POST['start_time'])
    && isset($_POST['bus_id'])
) {
    $data = $db->queryOneRow("select *from route_queue "
        . "where route_id = " . $_POST['route_id']
        . " and bus_id " . $_POST['bus_id']
        . " and status = 0"
        . " and date(start_time) = " . $_POST['start_time']);
    if ($data->num_rows > 0) {
        header('', true, 400);
    } else {
        $query = "insert into route_queue (route_id, queue, status,"
            . " driver_id, accept, cancel, start_time, bus_id)"
            . "VALUES (" . $_POST['route_id'] . ","
            . 0 . ","
            . 0 . ","
            . $_POST['driver_id'] . ","
            . 0 . ","
            . 0 . ","
            . $_POST['start_time'] . ","
            . $_POST['bus_id'] . ");";
        $id = $db->insertAndReturnId($query);
        if ($id != null) {
            header('{"id": ' . $id . '}', true, 200);
        } else {
            header(' ', true, 400);
        }
    }
}
?>