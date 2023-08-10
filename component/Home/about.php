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
            <i class="far fa-user-circle"></i><li class="item"><a href="/component/Profile/login.php?logout=true"><?php echo isset($_SESSION['email']) ? 'Log out' : 'Log in'; ?></a></li>
            </ul>
            </nav>
        </div>
    </div>
<div class="container">



    <!-- About -->
    <div id="About">
        <h1 class="about">About us</h1>
        <p>Welcome to Doctor Appointment ! Your trusted online platform for scheduling doctor appointments with ease and convenience. We understand the value of your time and the importance of your health, which is why we are dedicated to connecting you with top-notch healthcare professionals seamlessly.</p>
        <h1 class="mission">Our Mission</h1>
        <p>Our mission is to revolutionize the way you access healthcare services. We aim to create a user-friendly, secure, and efficient platform that empowers patients to take control of their healthcare journey. By bridging the gap between patients and medical practitioners, we strive to improve the overall healthcare experience for everyone involved.</p>
    </div>
</div>

</body>
</html>
