<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find</title>
    <link rel="stylesheet" href="./find.css">
    <link rel="stylesheet" href="/css/all.min.css">
</head>
<body>
<div class="banner">
    <div class="navbar">
        <img src="/image/file-ai.png" class="logo"/>
        <nav>
            <ul>
                <i class="fa-solid fa-house"></i><li class="item"><a href="/admin/admin.php">Home</a></li>
                <i class="fa-solid fa-user-doctor"></i><li class="item"><a href="/admin/new.php">New Doctor</a></li>
                <i class="far fa-user-circle"></i><li class="item"><a href="/admin/adminlogout.php"><?php echo isset($_SESSION['email']) ? 'Log out' : 'Log in'; ?></a></li>
            </ul>
        </nav>
    </div>
</div>

<div class="container">
    <table>
    <?php
                // Set the 'id' value in the session
            $_SESSION['id'] = $_POST['id'];
            $id=$_SESSION['id'];
            $_SESSION['date']=$_POST['date'];
            $date=$_SESSION['date'];
            // Rest of your code in find.php

            $conn=mysqli_connect("localhost:3306", "root", "", "healthsupport");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $query = "SELECT * FROM `user-ticket` WHERE date='$date' AND `doctor-id`='$id'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            $email=$row['email'];
            $query1 = "SELECT * FROM `user` WHERE email='$email'";
            $result1 = mysqli_query($conn, $query1);
            while ($row1 = mysqli_fetch_assoc($result1)) {
                ?>
                <tr>
                    <td>
                        <h2>Name: <?php echo $row1['name']; ?></h2>
                        <h4>Time: <?php echo $row['time']; ?></h4>
                        <h4>Phone: <?php echo $row['phone']; ?></h4>
                        <h3>Payment: <?php echo $row['payment']; ?></h3>
                        <h3>Trx: <?php echo $row['trxid']; ?></h3>
                        <button onclick="printRow(this.parentElement)">Print</button>
                    </td>
                </tr>
                <?php
            }
            }
            mysqli_close($conn);
            ?>
    </table>
    <div style="display: flex; justify-content: center;">
    <button onclick="deletePatient(<?php echo $id; ?>, '<?php echo $date; ?>')" style="font-size: 20px; padding: 12px 24px; width:600px; height:60px; margin-bottom: 40px;">Delete All</button>
    </div>
</div>

<script>
        function printRow(row) {
            var printContents = row.innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = `
                <div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>
                    <div style='display: flex; flex-direction: column; align-items: center; padding: 200px; border: 1px solid #ccc; background-color: #f9f9f9; text-align: center;'>
                        <div>${printContents}</div>
                    </div>
                </div>`;
            window.print();
            document.body.innerHTML = originalContents;
        }

        function deletePatient(id, date) {
        // Send the ID and date to patientdelete.php
        window.location.href = 'patientdelete.php?id=' + id + '&date=' + date;
    }
    </script>
</body>
</html>
