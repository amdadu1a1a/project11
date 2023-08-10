<?php
session_start();

$conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

#echo "Logged in as: " . $_SESSION['email'];

$Id = isset($_POST['Id']) ? $_POST['Id'] : '';
$my_ticket = isset($_POST['my_ticket']) ? $_POST['my_ticket'] : '';
$selectedDate = isset($_POST['selectedDate']) ? $_POST['selectedDate'] : '';
$my_time = isset($_POST['my_time']) ? $_POST['my_time'] : '';

// Use the values as needed
//echo "Id: " . $Id . "<br>";
//echo "My Ticket: " . $my_ticket . "<br>";
//echo "Selected Date: " . $selectedDate . "<br>";
//echo "My Time: " . $my_time . "<br>";

$day_name = "";
if (!empty($selectedDate)) {
    $day_name = date("l", strtotime($selectedDate));
}
//echo $day_name;

if (isset($_POST['success'])) {
    $email = $_SESSION['email'];
    $payment = 0;
    $phone = $_POST['phone'];
    $trxID = $_POST['text'];

    $sql1 = "INSERT INTO `user-ticket`(`email`, `doctor-id`, `date`, `time`, `phone`, `payment`, `trxid`) VALUES ('$email', '$Id', '$selectedDate', '$my_time','$phone', '$payment', '$trxID')";
    $sql="UPDATE `total_visit` SET $day_name=$my_ticket WHERE Id=$Id";
    if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
        echo "Data stored successfully in the database.";
        header("Location: ../support/care.php");
    } else {
        echo "Error storing data in the database: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReportAssistant</title>
    <link rel="stylesheet" href="./payment.css">
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
                <i class="fa-solid fa-notes-medical"></i><li class="item"><a href="./care.php">Care</a></li>
                <i class="far fa-user-circle"></i><li class="item"><a href="/component/Profile/logout.php"><?php echo isset($_SESSION['email']) ? 'Log out' : 'Log in'; ?></a></li>
            </ul>
        </nav>
    </div>
</div>
<div class="container">
    <div class="pay-form">
        <form action="payment.php" method="POST">
            <h1>Payment</h1>
            <div class="content">
                <div class="input-field">
                    <input type="phone" name="phone" placeholder="Payment number" autocomplete="nope" required>
                </div>
                <div class="input-field">
                    <input type="text" name="text" placeholder="TrxID" autocomplete="nope" required>
                </div>
            </div>
            <input type="hidden" name="Id" value="<?php echo $Id; ?>">
            <input type="hidden" name="my_ticket" value="<?php echo $my_ticket; ?>">
            <input type="hidden" name="selectedDate" value="<?php echo $selectedDate; ?>">
            <input type="hidden" name="my_time" value="<?php echo $my_time; ?>">
            <button type="submit" class="buton" name="success">Success</button>
        </form>
    </div>
</div>
</body>
</html>
