<?php
require "../include/DB.php";
$db = new DB();
if (isset($_POST['username'])
    && isset($_POST['password'])
    && isset($_POST['full_name'])
    && isset($_POST['identity_card'])
    && isset($_POST['day_of_birth'])
    && isset($_POST['driver_license'])
    && isset($_POST['staff_id'])
    && isset($_POST['sex'])
    && isset($_POST['phone_number'])
) {
    $data = $db->queryOneRow("select *from driver where username = '". $_POST['username'] ."'");
    if ($data->num_rows > 0) {
        header('', true, 400);
    } else {
        $query = "insert into driver (username, password, fullname,"
            . " identity_card, dob, driver_license, staff_id, sex, phone)"
            . "VALUES ('" . $_POST['username'] . "'),"
            . "'" . $_POST['password'] . "',"
            . "'" . $_POST['fullname'] . "',"
            . "'" . $_POST['identity_card'] . "',"
            . "'" . $_POST['dob'] . "',"
            . "'" . $_POST['driver_license'] . "',"
            . "'" . $_POST['staff_id'] . "',"
            . $_POST['sex'] . ","
            . "'" . $_POST['phone'] . "',"
            . ");";
        if ($db->query($query) === true) {
            header(' ', true, 200);
        } else {
            header(' ', true, 400);
        }
    }
}
?>