<?php
/**
 * Created by PhpStorm.
 * User: aizen115
 * Date: 6/3/2016
 * Time: 1:23 PM
 */
require "../include/DB.php";
$db = new DB();
$data = $db->query("select *from item");
if (isset($_GET['is_delete'])) {
    if ($_GET['is_delete'] == true) {
        $db->query('delete from item where id = ' . $_GET['id']);
        header("Refresh: 0; url='show.php'");
    }
}
?>
<table border="1">
    <tr>
        <th><input type="checkbox" name="vehicle" value="Bike">I have a bike<br></th>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Command</th>
    </tr>
    <?php
    foreach ($data as $key => $value) {
        echo "<tr>
                <td><a href='info.php?id=" . $value["id"] . "'>" . $value["id"] . "</a></td>
                <td>" . $value["name"] . "</td>
                <td>" . $value["price"] . "</td>
                <td><a href='show.php?is_delete=true&id=" . $value["id"] . "'>Xóa</a></td>
              </tr>";
    }
    ?>
</table>
