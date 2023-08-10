<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $nid = $_POST['nid'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $phone = $_POST['phone'];

    $conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");
    if ($conn->connect_error) {
        die("Failed to connect:" . $conn->connect_error);
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email already exists, show the popup
            $showPopup = true;
            $message = "Enter another Email Address!";
        } else {
            // Email doesn't exist, insert the new user
            $stmt = $conn->prepare("INSERT INTO user(name, age, nid, email, pass, phone) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $name, $age, $nid, $email, $pass, $phone);
            $result = $stmt->execute();

            if ($result) {
                // Redirect to a success page
                header("Location: success.php");
                exit();
            } else {
                $message = "You have entered wrong information!";
                $showPopup = false;
            }
        }
    }
} else {
    $showPopup = false;
}
?>

<!-- Rest of your HTML code -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="./signup.css">
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
        <i class="far fa-user-circle"></i><li class="item"><a href="/component/Profile/login.php">Account</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="signup-form">
            <form action="signup.php" method="POST">
                <div class="content">
                    <i class="fa-solid fa-user-plus"></i>
                    <div class="input-field">
                        <input type="text" name="name" placeholder="Name" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input type="int" name="age" placeholder="Age" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input type="int" name="nid" placeholder="NID" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Email" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Password" autocomplete="new-password" required>
                    </div>
                    <div class="input-field">
                        <input type="int" name="phone" placeholder="Phone" autocomplete="off" required>
                    </div>
                </div>
                <button type="submit" class="buton">Sign up</button>
            </form>
        </div>
    <?php if ($showPopup) { ?>
    <div class="popup">
        <img src="/image/warning.png" class="pop-image" alt="success">
        <h2 class="message"><?php echo $message; ?></h2>
        <a href="/component/Profile/signup.php"><button class="btton">Ok</button></a>
    </div>
<?php } ?>
    </div>
</body>
</html>
