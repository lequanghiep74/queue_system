<?php
require "../include/DB.php";
$db = new DB();
session_start();
if (isset($_GET['id'])
) {
    $query = "select * from student "
        . "where id = " . $_GET['id'];
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