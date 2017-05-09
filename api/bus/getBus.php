<?php
require "../include/DB.php";
$db = new DB();
session_start();
$query = "select * from bus";
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
?>