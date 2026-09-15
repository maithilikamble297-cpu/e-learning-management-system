<?php

session_start();

include "config/db.php";

// Check whether user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get student details
$sql = "SELECT name, email FROM users WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $user_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        /* ================= NAVBAR ================= */

        .navbar {
            background-color: #1e3a8a;
            color: white;
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 25px;
            margin: 0;
            padding: 0;
        }

        .nav-links li {
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .nav-links a:hover {
            color: #facc15;
        }

        /* ================= DASHBOARD ================= */

        .dashboard {
            width: 85%;
            max-width: 1200px;
            margin: 40px auto;
        }

        /* ================= WELCOME ================= */

        .welcome {
            background: linear-gradient(
                135deg,
                #2563eb,
                #7c3aed
            );

            color: white;

            padding: 35px;

            border-radius: 12px;

            margin-bottom: 30px;
        }

        .welcome h1 {
            margin: 0 0 10px 0;
            font-size: 32px;
        }

        .welcome p {
            margin: 0;
            font-size: 17px;
        }

        /* ================= PROFILE ================= */

        .profile {
            background-color: white;

            padding: 25px;

            border-radius: 10px;

            margin-bottom: 30px;

            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .profile h2 {
            color: #1e3a8a;

            margin-top: 0;

            margin-bottom: 20px;
        }

        .profile p {
            color: #333;

            font-size: 16px;

            margin: 10px 0;
        }

        /* ================= CARDS ================= */

        .cards {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 25px;
        }

        .card {
            background-color: white;

            padding: 30px 20px;

            text-align: center;

            border-radius: 10px;

            box-shadow:
                0 3px 10px rgba(0,0,0,0.1);

            min-height: 230px;

            display: flex;

            flex-direction: column;

            justify-content: center;

            align-items: center;
        }

        .card h3 {
            color: #1e3a8a;

            margin-top: 0;

            font-size: 20px;
        }

        .card p {
            color: #555;

            line-height: 1.5;

            min-height: 48px;
        }

        /* ================= BUTTON ================= */

        .btn {
            display: inline-block;

            background-color: #1e3a8a;

            color: white;

            padding: 11px 22px;

            text-decoration: none;

            border-radius: 5px;

            margin-top: 10px;

            font-weight: bold;
        }

        .btn:hover {
            background-color: #2563eb;
        }

        /* ================= FOOTER ================= */

        footer {
            background-color: #1e3a8a;

            color: white;

            text-align: center;

            padding: 20px;

            margin-top: 50px;
        }

        /* ================= MOBILE ================= */

        @media (max-width: 800px) {

            .cards {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;

                gap: 15px;

                text-align: center;
            }

            .nav-links {
                flex-direction: column;

                gap: 10px;
            }

            .dashboard {
                width: 92%;
            }

        }

    </style>

</head>


<body>


<!-- ================= NAVIGATION BAR ================= -->

<nav class="navbar">

    <div class="logo">
        E-Learning System
    </div>

    <ul class="nav-links">

        <li>
            <a href="index.php">Home</a>
        </li>

        <li>
            <a href="courses.php">Courses</a>
        </li>

        <li>
            <a href="dashboard.php">Dashboard</a>
        </li>

        <li>
            <a href="logout.php">Logout</a>
        </li>

    </ul>

</nav>


<!-- ================= DASHBOARD ================= -->

<div class="dashboard">


    <!-- WELCOME -->

    <div class="welcome">

        <h1>
            Welcome,
            <?php echo htmlspecialchars($user['name']); ?>! 👋
        </h1>

        <p>
            Welcome to your E-Learning Student Dashboard.
        </p>

    </div>


    <!-- PROFILE -->

    <div class="profile">

        <h2>My Profile</h2>

        <p>
            <strong>Name:</strong>
            <?php echo htmlspecialchars($user['name']); ?>
        </p>

        <p>
            <strong>Email:</strong>
            <?php echo htmlspecialchars($user['email']); ?>
        </p>

    </div>


    <!-- ================= DASHBOARD CARDS ================= -->

    <div class="cards">


        <!-- COURSES -->

        <div class="card">

            <h3>📚 My Courses</h3>

            <p>
                Explore available courses
                and start learning.
            </p>

           <a href="course.php" class="btn">View Courses</a>
        </div>


        <!-- STUDY MATERIAL -->

        <div class="card">

            <h3>📖 Study Materials</h3>

            <p>
                Access notes, videos and
                learning materials.
            </p>

           <a href="course.php" class="btn">Study Now</a>

        </div>


        <!-- QUIZ -->

        <div class="card">

            <h3>📝 Online Quiz</h3>

            <p>
                Test your knowledge with
                online quizzes.
            </p>

           <a href="course.php" class="btn">Take Quiz</a>

        </div>


        <!-- RESULTS -->

        <div class="card">

            <h3>📊 My Results</h3>

            <p>
                Check your quiz scores and
                performance.
            </p>

            <a href="result.php" class="btn">
                View Results
            </a>

        </div>


        <!-- PROFILE -->

        <div class="card">

            <h3>👤 My Profile</h3>

            <p>
                View your account information.
            </p>

            <a href="profile.php" class="btn">👤 My Profile</a>

        </div>


        <!-- LOGOUT -->

        <div class="card">

            <h3>🚪 Logout</h3>

            <p>
                Logout from your student account.
            </p>

            <a href="logout.php" class="btn">
                Logout
            </a>

        </div>


    </div>

</div>


<!-- ================= FOOTER ================= -->

<footer>

    <p>
        © 2026 E-Learning Management System
    </p>

</footer>


</body>

</html>