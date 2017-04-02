<?php
/**
 * Created by PhpStorm.
 * User: aizen115
 * Date: 6/3/2016
 * Time: 3:45 PM
 */
require "../include/DB.php";
$db = new DB();
if (isset($_GET['id'])) {
    $info = $db->queryOneRow("select *from item where id = " . $_GET['id']);

    echo 'id: ' . $info['id'] . '<br>'
        . 'name: ' . $info['name'] . '<br>'
        . 'price: ' . $info['price'];
}
?>
