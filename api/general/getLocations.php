<?php
require "../include/DB.php";
$db = new DB();
$query = "select * from location";
$data = $db->query($query);
if ($data) {
    header(json_encode($data), true, 200);
} else {
    header("", true, 500);
}
?>