<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the doctor record
    $conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete from doctor table
    $deleteDoctorQuery = "DELETE FROM doctor WHERE Id='$id'";
    mysqli_query($conn, $deleteDoctorQuery);

    // Delete from chamber_day table (if applicable)
    $deleteChamberDayQuery = "DELETE FROM `chamber_day` WHERE id='$id'";
    mysqli_query($conn, $deleteChamberDayQuery);

    // Delete from chamber_day table (if applicable)
    $deleteChamberDayQuery = "DELETE FROM `total_visit` WHERE Id='$id'";
    mysqli_query($conn, $deleteChamberDayQuery);

    mysqli_close($conn);

    // Redirect to the doctorlist.php page to refresh the doctor list
    header("Location: doctorlist.php");
    exit();
}
?>
