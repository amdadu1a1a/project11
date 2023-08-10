<?php
session_start();

$conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];
$query = "SELECT * FROM doctor WHERE Id='$id'";
$query1 = "SELECT * FROM chamber_day where id='$id'";
$result1 = mysqli_query($conn, $query1);
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$row1 = mysqli_fetch_assoc($result1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $speciality = $_POST['speciality'];
    $chamber = $_POST['chamber'];
    $time = $_POST['time'];
    $visit = $_POST['visit'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $Saturday = $_POST['Saturday'];
    $Sunday = $_POST['Sunday'];
    $Monday = $_POST['Monday'];
    $Tuesday = $_POST['Tuesday'];
    $Wednesday = $_POST['Wednesday'];
    $Thursday = $_POST['Thursday'];
    $Friday = $_POST['Friday'];

    // Update the doctor table
    $updateDoctorQuery = "UPDATE doctor SET name='$name', speciality='$speciality', chamber='$chamber', time='$time', visit='$visit' WHERE Id='$id'";
    mysqli_query($conn, $updateDoctorQuery);

    // Update the chamber_day table
    $updateChamberDayQuery = "UPDATE chamber_day SET name='$name',start='$start', end='$end', Saturday='$Saturday', Sunday='$Sunday', Monday='$Monday', Tuesday='$Tuesday', Wednesday='$Wednesday', Thursday='$Thursday', Friday='$Friday' WHERE id='$id'";
    mysqli_query($conn, $updateChamberDayQuery);

    $updatetotal = "UPDATE `total_visit` SET name='$name',start='$start', end='$end' WHERE id='$id'";
    mysqli_query($conn, $updatetotal);

    // Redirect to a confirmation page or any other desired page
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Doctor</title>
    <link rel="stylesheet" href="./updatedoctor.css">
    <link rel="stylesheet" href="/css/all.min.css">
</head>
<body>
<div class="banner">
    <div class="navbar">
        <img src="/image/file-ai.png" class="logo"/>
        <nav>
            <ul>
                <i class="fa-solid fa-house"></i><li class="item"><a href="/admin/admin.php">Home</a></li>
                <i class="fa-solid fa-user-doctor"></i><li class="item"><a href="/admin/new.php">New Doctor</a></li>
                <i class="far fa-user-circle"></i><li class="item"><a href="/admin/adminlogout.php"><?php echo isset($_SESSION['email']) ? 'Log out' : 'Log in'; ?></a></li>
            </ul>
        </nav>
    </div>
</div>
<div class="container">
    <h2>Update Doctor</h2>
    <form action="/admin/updatedoctor.php?id=<?php echo $row['Id']; ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
        </div>
        <div class="form-group">
            <label for="speciality">Speciality:</label>
            <input type="text" id="speciality" name="speciality" value="<?php echo $row['speciality']; ?>">
        </div>
        <div class="form-group">
            <label for="chamber">Chamber:</label>
            <input type="text" id="chamber" name="chamber" value="<?php echo $row['chamber']; ?>">
        </div>
        <div class="form-group">
            <label for="time">Time:</label>
            <input type="text" id="time" name="time" value="<?php echo $row['time']; ?>">
        </div>
        <div class="form-group">
            <label for="visit">Visit:</label>
            <input type="text" id="visit" name="visit" value="<?php echo $row['visit']; ?>">
        </div>
        <div class="form-group">
            <label for="start">Start:</label>
            <input type="text" id="start" name="start" value="<?php echo $row1['start']; ?>">
        </div>
        <div class="form-group">
            <label for="end">End:</label>
            <input type="text" id="end" name="end" value="<?php echo $row1['end']; ?>">
        </div>
        <div class="form-group">
            <label for="Saturday">Saturday:</label>
            <input type="text" id="Saturday" name="Saturday" value="<?php echo $row1['Saturday']; ?>">
        </div>
        <div class="form-group">
            <label for="Sunday">Sunday:</label>
            <input type="text" id="Sunday" name="Sunday" value="<?php echo $row1['Sunday']; ?>">
        </div>
        <div class="form-group">
            <label for="Monday">Monday:</label>
            <input type="text" id="Monday" name="Monday" value="<?php echo $row1['Monday']; ?>">
        </div>
        <div class="form-group">
            <label for="Tuesday">Tuesday:</label>
            <input type="text" id="Tuesday" name="Tuesday" value="<?php echo $row1['Tuesday']; ?>">
        </div>
        <div class="form-group">
            <label for="Wednesday">Wednesday:</label>
            <input type="text" id="Wednesday" name="Wednesday" value="<?php echo $row1['Wednesday']; ?>">
        </div>
        <div class="form-group">
            <label for="Thursday">Thursday:</label>
            <input type="text" id="Thursday" name="Thursday" value="<?php echo $row1['Thursday']; ?>">
        </div>
        <div class="form-group">
            <label for="Friday">Friday:</label>
            <input type="text" id="Friday" name="Friday" value="<?php echo $row1['Friday']; ?>">
        </div>
        <div class="center-button">
            <button type="submit" class="buy">Update</button>
        </div>
    </form>
</div>
</body>
</html>
