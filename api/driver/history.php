<?php
require "../include/DB.php";
$db = new DB();
$query = "select status, r.from_location.name, r.to_location.name, r.time as route_time, b.bus_no "
    . "from route_queue where driver_id = " . $_SESSION['user']['id'] . " "
    . "INNER JOIN route r ON route_queue.route_id = r.id "
    . "INNER JOIN bus b ON r.bus_id = b.id "
    . "INNER JOIN location lc ON r.from_location.id = lc.id "
    . "INNER JOIN location lc ON r.to_location.id = lc.id";
$data = $db->query($query);
if ($data) {
    header(json_encode($data), true, 200);
} else {
    header("", true, 500);
}
?>