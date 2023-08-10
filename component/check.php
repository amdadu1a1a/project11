<!DOCTYPE html>
<html>
<head>
    <title>Dhaka to BST Time Conversion</title>
</head>
<body>
    <h1>Dhaka to BST Time Conversion</h1>

    <form method="POST">
        <label for="dhaka-time">Enter Dhaka Time (HH:MM AM/PM):</label>
        <input type="text" id="dhaka-time" name="dhakaTime" required>
        <button type="submit">Convert</button>
    </form>
    
    <?php
    if (isset($_POST['dhakaTime'])) {
        $dhakaTimezone = new DateTimeZone('Asia/Dhaka');
        $bstTimezone = new DateTimeZone('Europe/London');
        
        $dhakaTime = $_POST['dhakaTime'];
        $datetime = DateTime::createFromFormat('h:i A', $dhakaTime, $dhakaTimezone);
        
        if ($datetime) {
            $datetime->setTimezone($bstTimezone);
            $convertedTime = $datetime->format('Y-m-d H:i:s');
            
            echo "<p>$dhakaTime in Dhaka time is equivalent to $convertedTime in BST.</p>";
        } else {
            echo "<p>Invalid time format. Please enter the time in HH:MM AM/PM format.</p>";
        }
    }
    ?>
</body>
</html>
