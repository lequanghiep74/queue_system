<?php
/**
 * Created by PhpStorm.
 * User: aizen115
 * Date: 6/3/2016
 * Time: 2:54 PM
 */
require('../include/DB.php');
if (isset($_GET['id'])) {
    $db = new DB();
    $db->query('delete from item where id = ' . $_GET['id']);
}
?>
