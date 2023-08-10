<?php
session_start();

$hospital = $_SESSION['hospital'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="./patient.css">
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
        <tr>
            <th>Details</th>
            <th>Date</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $query = "SELECT * FROM doctor WHERE chamber='$hospital'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['Id'];
            ?>
            <tr>
            <td>
                    <h3><?php echo $row['name']; ?></h3>
                    <h4>Speciality: <?php echo $row['speciality']; ?></h4>
                    <h4>Chamber: <?php echo $row['chamber']; ?></h4>
                    <h4>Time: <?php echo $row['time']; ?></h4>
                    <h3>Visit:  <?php echo $row['visit']; ?></h3>
            </td>
            <td>
    <form method="POST" class="item" action="find.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="date" id="datepicker" name="date" value="<?php echo $selectedDate; ?>" required>
    <button type="submit" class="button">FIND</button>
    </form>
    </td>
            </tr>
            <?php
        }
        mysqli_close($conn);
        ?>
    </table>
</div>
</body>
</html>
