<?php
$obj = array(
    ["id" => 1, "name" => "abc1"],
    ["id" => 2, "name" => "abc2"],
    ["id" => 3, "name" => "abc3"],
    ["id" => 4, "name" => "abc4"]
);
?>
<!DOCTYPE html>
<html>
<head>
    <title>L.A.M.P</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
<table>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Tùy Chọn</th>
    </tr>
    <?php
    foreach ($obj as $key => $value) {
        echo "<tr><td>" . $value["id"] . "</td><td>" . $value["name"] . "</td><td>Xóa</td></tr>";
    }
    ?>
</table>
<form action="indexItem.php" method="get">
    Num A: <input type="number" name="numA"><br>
    Num B: <input type="number" name="numB"><br>
    <input type="submit" value="submit">
</form>
<?php
    if (isset($_GET["numA"]) && isset($_GET["numB"])) {
        echo $_GET["numA"] + $_GET["numB"];
    }
?>
</body>
</html>