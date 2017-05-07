<?php
require "../include/DB.php";
$db = new DB();
if (isset($_POST['username'])
    && isset($_POST['password'])
    && isset($_POST['full_name'])
    && isset($_POST['identity_id'])
    && isset($_POST['day_of_birth'])
    && isset($_POST['driver_license'])
    && isset($_POST['staff_id'])
    && isset($_POST['sex'])
    && isset($_POST['phone_number'])
) {
    $data = $db->queryOneRow("select *from driver where username = '". $_POST['username'] ."'");
    if ($data != null) {
        header('Username is existing', true, 400);
        echo 'Username is existing';
    } else {
        $query = "insert into driver (username, password, fullname,"
            . " identity_id, dob, driver_license, staff_id, sex, phone)"
            . "VALUES ('" . $_POST['username'] . "',"
            . "'" . $_POST['password'] . "',"
            . "'" . $_POST['full_name'] . "',"
            . "'" . $_POST['identity_id'] . "',"
            . "STR_TO_DATE('" . $_POST['day_of_birth'] . "', '%d/%m/%Y'),"
            . "'" . $_POST['driver_license'] . "',"
            . "'" . $_POST['staff_id'] . "',"
            . $_POST['sex'] . ","
            . "'" . $_POST['phone_number'] . "')";
        if ($db->query($query) === true) {
            header(' ', true, 200);
        } else {
            header(' ', true, 400);
            echo $query;
        }
    }
}
else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>