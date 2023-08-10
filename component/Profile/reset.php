<?php

session_start();

//echo "Logged in as: " . $_SESSION['email'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Health Support</title>
    <link rel="stylesheet" href="./reset.css">
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
            <i class="far fa-user-circle"></i><li class="item"><a href="/component/support/care.php">Care</a></li>
            <i class="far fa-user-circle"></i><li class="item"><a href="/component/Profile/login.php?logout=true"><?php echo isset($_SESSION['email']) ? 'Log out' : 'Log in'; ?></a></li>
            </ul>
            </nav>
        </div>
    </div>
<div class="container">
    <div class="popup">
        <img src="/image/love.png" class="pop-image" alt="success">
        <h2 class="message">Successfully Password Changed !</h2>
        <a href="/component/Profile/login.php"><button class="btton">Log in</button></a>
    </div>
</div>
</body>
</html>
