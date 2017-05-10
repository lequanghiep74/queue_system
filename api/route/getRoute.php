<?php
require "../include/DB.php";
$db = new DB();
if (isset($_POST['from_location_id'])
    && isset($_POST['to_location_id'])
    && isset($_POST['bus_station_id'])
) {
    $data = $db->queryOneRow("select *from route "
        . "where from_location_id = " . $_POST['from_location_id'] . " "
        . "and to_location_id = " . $_POST['to_location_id'] . " "
        . "and bus_station_id = " . $_POST['bus_station_id'] . " "
        . "inner join location on route.from_location_id = location.id " . " "
        . "inner join location on route.to_location_id = location.id " . " "
        . "inner join bus_station on route.bus_station_id = bus_station.id");
    if ($data) {
        header(json_encode($data), true, 200);
    } else {
        header("", true, 500);
    }
}
?>