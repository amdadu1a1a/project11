<?php
session_start();

// echo "Logged in as: " . $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validate email and passwords

    // Check if the passwords match
    if ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match";
    } else {
        // Update the password in the database for the given email
        $conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");
        if ($conn->connect_error) {
            die("Failed to connect: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("UPDATE user SET pass = ? WHERE email = ?");
        $stmt->bind_param("ss", $newPassword, $email);
        $stmt->execute();

        // Redirect the user to a password reset success page or login page
        header("Location: reset.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Support</title>
    <link rel="stylesheet" href="./forget.css">
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
        <div class="login-form">
            <form action="forget.php" method="POST">
                <h1>Forget Password</h1>
                <?php if (isset($error)): ?>
                    <p class="error-message"><?php echo $error; ?></p>
                <?php endif; ?>
                <div class="content">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Email" autocomplete="nope" required>
                    </div>
                    <div class="input-field">
                        <input type="password" name="new-password" placeholder="New Password" autocomplete="new-password" required>
                    </div>
                    <div class="input-field">
                        <input type="password" name="confirm-password" placeholder="Confirm Password" autocomplete="new-password" required>
                    </div>
                </div>
                <button type="submit" class="buton">Submit</button>
            </form>
        </div>
    </div>
</body>
