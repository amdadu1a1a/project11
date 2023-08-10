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
    <title>DoctorSupport</title>
    <link rel="stylesheet" href="./doctor.css">
    <link rel="stylesheet" href="/css/all.min.css">
</head>
<body>
<?php
$conn = mysqli_connect("localhost:3306", "root", "", "healthsupport");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the search term from the form
$searchTerm = $_GET['searchitem'];

// Prepare the SQL query to search for doctors
$query = "SELECT * FROM doctor WHERE search LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $query);
?>
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
    <label>Find a Specialist Doctor :</label><br>
    <form action="search.php" method="GET">
        <input type="text" list="Doctorlist" name="searchitem" id="searchInput">
        <button class="bton">Search</button>
    </form>
    <datalist id="Doctorlist">
        <option value="Burn & Plastic"></option>
        <option value="Cardiology"></option>
        <option value="Cancer"></option>
        <option value="Colorectal Surgery"></option>
        <option value="Dental"></option>
        <option value="Diabetics"></option>
        <option value="Eye"></option>
        <option value="ENT"></option>
        <option value="General Surgery"></option>
        <option value="Hepatology"></option>
        <option value="Urology"></option>
        <option value="Medicine"></option>
    </datalist>
</div>
<div class="main"> 
    <table>
        <tr>
            <th>Photo</th>
            <th>Details</th>
            <th>Cart</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><img src="data:image;base64,<?php echo base64_encode($row['image']); ?>"></td>
                <td>
                    <h3><?php echo $row['name']; ?></h3>
                    <h4>Speciality: <?php echo $row['speciality']; ?></h4>
                    <h4>Chamber: <?php echo $row['chamber']; ?></h4>
                    <h4>Time: <?php echo $row['time']; ?></h4>
                </td>
                <td>
                <button class="buy" onclick="<?php echo isset($_SESSION['email']) ? "location.href='visit.php?Id=" . urlencode($row['Id']) . "'" : "location.href='/component/Profile/login.php'"; ?>">Yes</button>
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
