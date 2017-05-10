<?php
require "../include/DB.php";
$db = new DB();
if (isset($_GET['type'])
    && isset($_GET['id'])
) {
    if ($_GET['type'] == 'info') {
        if (isset($_GET['full_name'])
            && isset($_GET['identity_id'])
            && isset($_GET['day_of_birth'])
            && isset($_GET['driver_license'])
            && isset($_GET['staff_id'])
            && isset($_GET['phone_number'])
        ) {
            $query = "update driver set "
                . "fullname = '" . $_GET['full_name'] . "', "
                . "identity_id = '" . $_GET['identity_id'] . "', "
                . "dob = STR_TO_DATE('" . $_GET['day_of_birth'] . "', '%d/%m/%Y'), "
                . "driver_license = '" . $_GET['driver_license'] . "', "
                . "staff_id = '" . $_GET['staff_id'] . "', "
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
            $query = "update driver set "
                . "password = '" . $_GET['password'] . "' "
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
    }
} else {
    header('Missing data', true, 400);
    echo 'Missing data';
}
?>