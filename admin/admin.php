<?php

session_start();

//echo "Logged in as: " . $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="./admin.css">
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
<table>
        <tr>
            <th><img src="/image/doctor support.png" alt=""></th>
            <th><img src="/image/png-clipart-medicine-physician-health-care-medical-record-patient-health-thumbnail.png"></th>
        </tr>
        <tr>
            <td><a href="/admin/doctorlist.php"><button class="btn btn1">Doctor List</button></a></td>
            <td><a href="/admin/patient.php"><button class="btn btn1">Patient List</button></a></td>
        </tr>
    </table>
    </div>
</body>
</html>