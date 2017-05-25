<?php
require "../include/DB.php";
$db = new DB();
if (isset($_GET['type'])
    && isset($_GET['id'])
) {
    if ($_GET['type'] == 'info') {
        if (isset($_GET['full_name'])
            && isset($_GET['day_of_birth'])
            && isset($_GET['student_no'])
            && isset($_GET['phone_number'])
        ) {
            $query = "update student set "
                . "fullname = '" . $_GET['full_name'] . "', "
                . "dob = STR_TO_DATE('" . $_GET['day_of_birth'] . "', '%d/%m/%Y'), "
                . "student_no = '" . $_GET['student_no'] . "', "
                . "phone = '" . $_GET['phone_number'] . "' "
                . "where id = " . $_GET['id'];
            if ($db->query($query) === true) {
                header(' ', true, 200);
            } else {
                header(' ', true, 400);
                echo 'Error!!!';
            }
        } else {
            header('Missing data', true, 400);
            echo 'Missing data';
        }
    } else {
        if (isset($_GET['password'])) {
            $query = "update student set "
                . "password = '" . $_GET['password'] . "' "
                . "where id = " . $_GET['id'];
            echo $query;
            if ($db->query($query) === true) {
                header(' ', true, 200);
            } else {
                header(' ', true, 400);
                echo 'Error!!!';
            }
        } else {
            header('Missing data', true, 400);
            echo 'Missing data';
        }
    }
} else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>