<?php
session_start();
//echo "Logged in as: " . $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReportAssistant</title>
    <link rel="stylesheet" href="./care.css">
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
                    <i class="fa-solid fa-notes-medical"></i><li class="item"><a href="#">Care</a></li>
                    <i class="far fa-user-circle"></i><li class="item"><a href="/component/Profile/logout.php"><?php echo isset($_SESSION['email']) ? 'Log out' : 'Log in'; ?></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="container">
        <table>
            <tr>
                <th>Doctor Appointment</th>
            </tr>
            <?php
            $conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
            $query = "SELECT * FROM `user-ticket` WHERE email='$email'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $doctorId = $row['doctor-id'];
                $query1 = "SELECT * FROM doctor WHERE Id='$doctorId'";
                $doctorResult = mysqli_query($conn, $query1);
                $doctorRow = mysqli_fetch_assoc($doctorResult);
                ?>
                <tr>
                    <td>
                        <h2><?php echo $doctorRow['name']; ?></h2>
                        <h4><?php echo $doctorRow['speciality']; ?></h4>
                        <h4>Chamber: <?php echo $doctorRow['chamber']; ?></h4>
                        <h3>Date: <?php echo $row['date']; ?></h3>
                        <h3>Time: <?php echo $row['time']; ?></h3>
                        <button onclick="printRow(this.parentElement)">Print</button>
                    </td>
                </tr>
                <?php
            }
            mysqli_close($conn);
            ?>
        </table>
    </div>
    
    <script>
        function printRow(row) {
            var printContents = row.innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = `
                <div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>
                    <div style='display: flex; flex-direction: column; align-items: center; padding: 200px; border: 1px solid #ccc; background-color: #f9f9f9; text-align: center;'>
                    <img src="D://Health%20Support/image/serial.png" style="width: 200px; height: 200px; margin-bottom: 20px;">
                        <div>${printContents}</div>
                    </div>
                </div>`;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>
