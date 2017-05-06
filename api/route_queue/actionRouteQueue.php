<?php
require "../include/DB.php";
$db = new DB();
if (isset($_GET['id'])
    && isset($_GET['status'])
) {
    $action = $_GET['status'] == true ? "accept" : "cancel";
    $query = "update route_queue set " . $action . " = " . $action . " + 1 where id = " . $_GET['id'];
    $id = $db->query($query);
    if ($id != null) {
        header(' ', true, 200);
    } else {
        header(' ', true, 400);
    }
}
?>