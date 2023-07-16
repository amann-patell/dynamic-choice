<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "india") or die("Connection Failed");

// Check the type of data requested from the client
if ($_POST['type'] == "") {
    // Client requests initial state data
    $sql = "SELECT * FROM misc_state_table";
    $result = mysqli_query($con, $sql) or die("Query Unsuccessful.");

    // Prepare the HTML options for states
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='{$row['misc_state_id']}'>{$row['misc_state_name']}</option>";
    }
} else if ($_POST['type'] == "districtData" && isset($_POST['state'])) {
    // Client requests district data based on the selected state
    $stateId = $_POST['state'];

    $sql = "SELECT * FROM misc_district_table WHERE misc_district_state_id = $stateId";
    $result = mysqli_query($con, $sql) or die("Query Unsuccessful.");

    // Prepare the HTML options for districts
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='{$row['misc_district_id']}'>{$row['misc_district_name']}</option>";
    }
}

// Send the generated HTML options back to the client
echo $options;
