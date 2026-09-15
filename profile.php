<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "config/db.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT name, email FROM users WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare Error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $name, $email);

if (!mysqli_stmt_fetch($stmt)) {
    die("User profile not found.");
}

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile - E-Learning LMS</title>

<style>

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f3f4f6;
}

.navbar {
    background: #2563eb;
    color: white;
    padding: 15px 30px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar h2 {
    margin: 0;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
}

.container {
    width: 90%;
    max-width: 600px;
    margin: 50px auto;
}

.profile-card {
    background: white;
    padding: 35px;
    border-radius: 12px;

    box-shadow: 0 4px 15px rgba(0,0,0,0.1);

    text-align: center;
}

.profile-icon {
    font-size: 70px;
    margin-bottom: 10px;
}

.profile-card h1 {
    color: #2563eb;
    margin-bottom: 30px;
}

.info {
    text-align: left;

    background: #f9fafb;

    padding: 15px;

    margin: 12px 0;

    border-radius: 8px;
}

.info strong {
    color: #374151;
}

.info span {
    color: #111827;
}

.btn {
    display: inline-block;

    margin-top: 25px;

    padding: 12px 20px;

    background: #2563eb;

    color: white;

    text-decoration: none;

    border-radius: 7px;
}

.btn:hover {
    background: #1d4ed8;
}

</style>

</head>

<body>

<div class="navbar">

    <h2>📚 E-Learning LMS</h2>

    <div>

        <a href="dashboard.php">Dashboard</a>

        <a href="course.php">Courses</a>

        <a href="logout.php">Logout</a>

    </div>

</div>


<div class="container">

    <div class="profile-card">

        <div class="profile-icon">👤</div>

        <h1>My Profile</h1>

        <div class="info">

            <strong>Name:</strong>

            <span>
                <?php echo htmlspecialchars($name); ?>
            </span>

        </div>


        <div class="info">

            <strong>Email:</strong>

            <span>
                <?php echo htmlspecialchars($email); ?>
            </span>

        </div>


        <div class="info">

            <strong>Role:</strong>

            <span>Student</span>

        </div>


        <a href="dashboard.php" class="btn">
            ← Back to Dashboard
        </a>

    </div>

</div>

</body>

</html>