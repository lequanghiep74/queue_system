<?php
require "../include/DB.php";
$db = new DB();
if (isset($_GET['username'])
    && isset($_GET['password'])
    && isset($_GET['full_name'])
    && isset($_GET['day_of_birth'])
    && isset($_GET['student_no'])
    && isset($_GET['sex'])
    && isset($_GET['phone_number'])
) {
    $data = $db->queryOneRow("select *from student where username = '". $_GET['username'] ."'");
    if ($data != null) {
        header('Username is existing', true, 400);
        echo 'Username is existing';
    } else {
        $query = "insert into student (username, password, fullname,"
            . " dob, student_no, sex, phone)"
            . "VALUES ('" . $_GET['username'] . "',"
            . "'" . $_GET['password'] . "',"
            . "'" . $_GET['full_name'] . "',"
            . "STR_TO_DATE('" . $_GET['day_of_birth'] . "', '%d/%m/%Y'),"
            . "'" . $_GET['student_no'] . "',"
            . $_GET['sex'] . ","
            . "'" . $_GET['phone_number'] . "')";
        if ($db->query($query) === true) {
            header(' ', true, 200);
        } else {
            header(' ', true, 400);
            echo 'Error!!!';
        }
    }
}
else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>