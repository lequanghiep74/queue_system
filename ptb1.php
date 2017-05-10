<!DOCTYPE html>
<html>
<head>
    <title>L.A.M.P</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
<form action="ptb1.php" method="get">
    Num A: <input type="number" name="numA"><br>
    Num B: <input type="number" name="numB"><br>
    <input type="submit" value="submit">
</form>
<?php
if (isset($_GET["numA"]) && isset($_GET["numB"])){
    $numA = $_GET["numA"];
    $numB = $_GET["numB"];
    if ($numA != 0 && $numB != 0) {
        echo -$numB / $numA;
    }
    else if ($numA == 0 && $numB == 0) {
        echo "VSN";
    }
    else if ($numA == 0) {
        echo "VN";
    }
}
?>
</body>
</html>