<?php
session_start();

$conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$hospital = $_SESSION['hospital'];

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
    $search = $_POST['Search'];

    if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['Image']['tmp_name'];
        $imageData = mysqli_real_escape_string($conn, file_get_contents($image));
    } else {
        $imageData = null;
    }
    $createDoctorQuery = "INSERT INTO doctor (name, speciality, chamber, time, visit, search, image) VALUES ('$name', '$speciality', '$chamber', '$time', '$visit', '$search', '$imageData')";
    mysqli_query($conn, $createDoctorQuery);
    $newDoctorId = mysqli_insert_id($conn);
    $createChamberDayQuery = "INSERT INTO chamber_day (id, name, start, end, Saturday, Sunday, Monday, Tuesday, Wednesday, Thursday, Friday) VALUES ('$newDoctorId', '$name', '$start', '$end', '$Saturday', '$Sunday', '$Monday', '$Tuesday', '$Wednesday', '$Thursday', '$Friday')";
    mysqli_query($conn, $createChamberDayQuery);


    $createtotal = "INSERT INTO `total_visit` (id, name, start, end, Saturday, Sunday, Monday, Tuesday, Wednesday, Thursday, Friday,chamber) VALUES ('$newDoctorId', '$name', '$start', '$end', '0', '0', '0', '0', '0', '0', '0','$chamber')";
    mysqli_query($conn, $createtotal);


    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Doctor</title>
    <link rel="stylesheet" href="./new.css">
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
    <h2>New Doctor</h2>
    <form action="/admin/new.php" method="POST" enctype="multipart/form-data">
    <div class="form-image">
    <label for="Image">Image:</label>
    <input type="file" id="Image" name="Image">
    </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="speciality">Speciality:</label>
            <input type="text" id="speciality" name="speciality" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="chamber">Chamber:</label>
            <input type="text" id="chamber" name="chamber" value="<?php echo $hospital ?>">
        </div>
        <div class="form-group">
            <label for="time">Time:</label>
            <input type="text" id="time" name="time" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="visit">Visit:</label>
            <input type="text" id="visit" name="visit" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="start">Start:</label>
            <input type="text" id="start" name="start" value="00:00:00" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="end">End:</label>
            <input type="text" id="end" name="end" value="00:00:00" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="Saturday">Saturday:</label>
            <input type="text" id="Saturday" name="Saturday" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="Sunday">Sunday:</label>
            <input type="text" id="Sunday" name="Sunday" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="Monday">Monday:</label>
            <input type="text" id="Monday" name="Monday" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="Tuesday">Tuesday:</label>
            <input type="text" id="Tuesday" name="Tuesday" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="Wednesday">Wednesday:</label>
            <input type="text" id="Wednesday" name="Wednesday" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="Thursday">Thursday:</label>
            <input type="text" id="Thursday" name="Thursday" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="Friday">Friday:</label>
            <input type="text" id="Friday" name="Friday" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="Search">Search:</label>
            <input type="text" id="Search" name="Search" list="Doctorlist" autocomplete="off" required>
        </div>

        <div class="center-button">
            <button type="submit" class="buy">Create</button>
        </div>
    </form>
    <datalist id="Doctorlist">
            <option value="Burn & Plastic"></option>
            <option value="Cardiology"></option>
            <option value="Cancer"></option>
            <option value="Colorectal Surgery"></option>
            <option value="Dental"></option>
            <option value="Diabetics"></option>
            <option value="Eye"></option>
            <option value="ENT"></option>
            <option value="General Surgery"></option>
            <option value="Hepatology"></option>
            <option value="Urology"></option>
            <option value="Medicine"></option>
        </datalist>
</div>
</body>
</html>
