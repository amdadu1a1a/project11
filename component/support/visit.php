<?php
session_start();
//echo "Logged in as: " . $_SESSION['email'];

$today = date("Y-m-d");
$maxDate = date("Y-m-d", strtotime("+6 days"));
$selectedDate = isset($_POST["date"]) && !empty($_POST["date"]) ? $_POST["date"] : "";

$day_name = "";
if (!empty($selectedDate)) {
    $day_name = date("l", strtotime($selectedDate));
}

$row = null; // Initialize $row as null
$offDay = false;

if (isset($_GET['Id'])) {
    $Id = $_GET['Id'];
    // Connect to your database
    $conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Retrieve the name associated with the Id from the database
    $query = "SELECT * FROM chamber_day WHERE Id = '$Id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];

    date_default_timezone_set('Asia/Dhaka');
    $start = date("h:i A", strtotime($row['start']));
    $end = date("h:i A", strtotime($row['end']));

    $query = "SELECT * FROM total_visit WHERE Id = '$Id'";
    $result_total = mysqli_query($conn, $query);
    $row_total = mysqli_fetch_assoc($result_total);

    $finish_ticket = isset($row_total[$day_name]) ? $row_total[$day_name] : 0;
    $my_ticket = isset($row_total[$day_name]) ? $row_total[$day_name] + 1 : 1;
    $my_time = date("h:i A", strtotime($start) + ($my_ticket * 10 * 60));
    $day = date("l", strtotime($selectedDate)); 
    #echo $day;
    #echo $Id;

    mysqli_close($conn);

    #echo "Clicked: " . $name;

    // Check if it's an off day
    if (!empty($day_name) && $row !== null && isset($row[$day_name]) && $row[$day_name] != 1) {
        $offDay = true;
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
    <link rel="stylesheet" href="./visit.css">
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
        <h1>Select Your Appointment</h1>
        <div class="find-ticket">
            <h2 class="item"><?php echo $name; ?></h2>
            <h2 class="item">Start time : <?php echo $start; ?></h2>
            <h2 class="item">End Time : <?php echo $end; ?></h2>
            <form method="POST" class="item">
            <input type="date" id="datepicker" name="date" min="<?php echo $today; ?>" max="<?php echo $maxDate; ?>" value="<?php echo $selectedDate; ?>" required>
                <button type="submit" class="button">FIND</button>
            </form>
        </div>
    </div>
    <?php if (!empty($day_name) && $row !== null && isset($row[$day_name]) && $row[$day_name] == 1 && !$offDay) : ?>
        <div class="find">
            <div class="ticket-details">
                <div class="ticket-info">
                    <h2>Total Finished Appointment:</h2>
                    <p><?php echo $finish_ticket ?></p>
                </div>
                <div class="ticket-info">
                    <h2>Your Appointment:</h2>
                    <p><?php echo $my_ticket ?></p>
                </div>
                <div class="ticket-info">
                    <h2>Date:</h2>
                    <p><?php echo $selectedDate?></p>
                </div>
                <div class="ticket-info">
                    <h2>Time:</h2>
                    <p><?php echo $my_time ?></p>
                </div>
            </div>
            <form method="POST" action="payment.php" class="confirm-form">
    <input type="hidden" name="Id" value="<?php echo $Id; ?>">
    <input type="hidden" name="my_ticket" value="<?php echo $my_ticket; ?>">
    <input type="hidden" name="selectedDate" value="<?php echo $selectedDate; ?>">
    <input type="hidden" name="my_time" value="<?php echo $my_time; ?>">
    <button type="submit" class="confirm" name="confirm">Confirm</button>
</form>
        </div>
    <?php elseif ($offDay) : ?>
        <div class="fail">
            <h1>OFF DAY !</h1>
        </div>
    <?php endif; ?>
</body>
</html>