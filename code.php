<?php

$con = mysqli_connect("localhost", "root", "", "india") or die("Connection Failed");

if ($_POST['type'] == "") {

    $sql = "SELECT * FROM misc_state_table";
    $query = mysqli_query($con, $sql) or die("Query Unsuccessful.");

    $str = "";

    while ($row = mysqli_fetch_assoc($query)) {
        $str .= "<option value='{$row['misc_state_id']}'>{$row['misc_state_name']}</option>";
    }
} else if ($_POST['type'] == "districtData") {

    $sql = "SELECT * FROM misc_district_table WHERE misc_district_state_id  = {$_POST['id']}";
    $query = mysqli_query($con, $sql) or die("Query Unsuccessful.");

    $str = "";

    while ($row = mysqli_fetch_assoc($query)) {
        $str .= "<option value='{$row['misc_district_id']}'>{$row['misc_district_name']}</option>";
    }
}



echo $str;
