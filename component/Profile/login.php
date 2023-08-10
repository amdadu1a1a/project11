<?php
session_start();

//echo "Logged in as:" .$_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['email'];
    $pass = $_POST['password'];

    $conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");

    if ($conn->connect_error) {
        die("Failed to connect:" . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email=?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if ($data['pass'] == $pass) {
                $_SESSION['email'] = $data['email']; // Store user's email in session
                $_SESSION['name'] = $data['name']; // Store user's name in session
                header("Location: ../Home/home.php"); // Redirect to the dashboard page
                exit();
            } else {
                $error = "Incorrect Username or password!";
        header("Location: login.php?error=" . urlencode($error));
        exit();
            }
        } else {
            $error = "Incorrect Username or password!";
        header("Location: login.php?error=" . urlencode($error));
        exit();
        }
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
    <link rel="stylesheet" href="./login.css">
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
            <i class="far fa-user-circle"></i><li class="item"><a href="/component/Profile/login.php?logout=true">Log in</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="login-form">
            <form action="login.php" method="POST">
                <h1>Login</h1>
                <?php if (!empty($_GET['error'])) { ?>
                <p class="error-message"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <div class="content">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Email" autocomplete="nope" required>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Password" autocomplete="new-password" required>
                    </div>
                    <a href="/component/Profile/forget.php" class="link">Forgot Your Password?</a>
                    <a href="/component/Profile/signup.php" class="Link">Create New</a>
                </div>
                <button type="submit" class="buton">Sign in</button>
            </form>
        </div>
    </div>
</body>
</html>
