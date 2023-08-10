<?php

session_start();

//echo "Logged in as: " . $_SESSION['email'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Health Support</title>
    <link rel="stylesheet" href="./about.css">
    <link rel="stylesheet" href="/css/all.min.css">
</head>
<body>
<div class="banner">
        <div class="navbar">
            <img src="/image/file-ai.png" class="logo"/>
            <nav>
                <ul>
                <i class="fa-solid fa-house"></i><li class="item"><a href="/component/Home/home.php">Home</a></li>
            <i class="fa-solid fa-users-gear"></i><li class="item"><a href="/component/Home/about.php">About us</a></li>
            <i class="fa-solid fa-notes-medical"></i><li class="item"><a href="/component/support/care.php">Care</a></li>
            <i class="far fa-user-circle"></i><li class="item"><a href="/component/Profile/logout.php"><?php echo isset($_SESSION['email']) ? 'Log out' : 'Log in'; ?></a></li>
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
            <td><a href="/component/support/Doctor.php"><button class="btn btn1">Doctor List</button></a></td>
            <td><a href="/component/support/Report.php"><button class="btn btn1">Report type</button></a></td>
        </tr>
    </table>
</div>

</body>
</html>
