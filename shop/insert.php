<?php
/**
 * Created by PhpStorm.
 * User: aizen115
 * Date: 6/3/2016
 * Time: 1:23 PM
 */
require "../include/DB.php";
$db = new DB();
if (isset($_POST['name']) && isset($_POST['price'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    echo $db->query("insert into item (name, price) values ('".$name."', ".$price.")");
}
?>
<form action="insert.php" method="post">
    Name: <input type="text" name="name"><br>
    Price: <input type="number" name="price"><br>
    <input type="submit">
</form>
