<?php
    session_start();
    // Destroy session
    if(session_unset()) {
        // Redirecting To Home Page
        header("Location: login.php");
    }
?>