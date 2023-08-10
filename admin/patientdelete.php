<?php
$id = $_GET['id'];
$date = $_GET['date'];
$day_name = date("l", strtotime($date));

$conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "DELETE FROM `user-ticket` WHERE `doctor-id`='$id' AND date='$date'";
$result = mysqli_query($conn, $query);

$updatetotal = "UPDATE `total_visit` SET `$day_name`='0' WHERE id='$id'";
mysqli_query($conn, $updatetotal);

mysqli_close($conn);

// Redirect to the patient.php page to refresh the patient list
header("Location: patient.php");
exit();
?>
