<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Login check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Courses - E-Learning Management System</title>

    <style>

        * {
            box-sizing: border-box;
        }

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
            margin-left: 15px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .heading {
            text-align: center;
            margin-bottom: 35px;
        }

        .heading h1 {
            color: #1f2937;
        }

        .heading p {
            color: #6b7280;
        }

        .courses {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .course-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .course-card h2 {
            color: #2563eb;
            margin-top: 0;
        }

        .course-card p {
            color: #555;
            line-height: 1.6;
        }

        .info {
            margin: 15px 0;
            color: #374151;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px 3px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .quiz-btn {
            background: #059669;
        }

        .quiz-btn:hover {
            background: #047857;
        }

        .logout {
            background: #dc2626;
        }

        .logout:hover {
            background: #b91c1c;
        }

    </style>

</head>

<body>

<!-- Navbar -->

<div class="navbar">

    <h2>📚 E-Learning LMS</h2>

    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="result.php">My Results</a>
        <a href="logout.php">Logout</a>
    </div>

</div>


<!-- Main Container -->

<div class="container">

    <div class="heading">

        <h1>📚 Available Courses</h1>

        <p>
            Choose a course and start learning.
        </p>

    </div>


    <div class="courses">


        <!-- Python -->

        <div class="course-card">

            <h2>🐍 Python Programming</h2>

            <p>
                Learn Python programming from basic concepts
                to advanced programming.
            </p>

            <div class="info">
                <strong>Duration:</strong> 8 Weeks
            </div>

            <div class="info">
                <strong>Level:</strong> Beginner to Advanced
            </div>

            <a
                href="lesson.php?course=python&lesson=1"
                class="btn"
            >
                📖 Study Materials
            </a>

            <a
                href="quiz.php?course=python"
                class="btn quiz-btn"
            >
                📝 Take Quiz
            </a>

        </div>


        <!-- Web Development -->

        <div class="course-card">

            <h2>🌐 Web Development</h2>

            <p>
                Learn HTML, CSS, JavaScript and basic
                web development concepts.
            </p>

            <div class="info">
                <strong>Duration:</strong> 10 Weeks
            </div>

            <div class="info">
                <strong>Level:</strong> Beginner
            </div>

            <a
                href="lesson.php?course=web&lesson=1"
                class="btn"
            >
                📖 Study Materials
            </a>

            <a
                href="quiz.php?course=web"
                class="btn quiz-btn"
            >
                📝 Take Quiz
            </a>

        </div>


        <!-- Database -->

        <div class="course-card">

            <h2>🗄️ Database Management</h2>

            <p>
                Learn database concepts, SQL queries,
                tables and MySQL.
            </p>

            <div class="info">
                <strong>Duration:</strong> 6 Weeks
            </div>

            <div class="info">
                <strong>Level:</strong> Beginner to Intermediate
            </div>

            <a
                href="lesson.php?course=database&lesson=1"
                class="btn"
            >
                📖 Study Materials
            </a>

            <a
                href="quiz.php?course=database"
                class="btn quiz-btn"
            >
                📝 Take Quiz
            </a>

        </div>


        <!-- Cyber Security -->

        <div class="course-card">

            <h2>🔐 Cyber Security</h2>

            <p>
                Learn basic cybersecurity concepts,
                threats and online safety.
            </p>

            <div class="info">
                <strong>Duration:</strong> 8 Weeks
            </div>

            <div class="info">
                <strong>Level:</strong> Beginner
            </div>

            <a
                href="lesson.php?course=cyber&lesson=1"
                class="btn"
            >
                📖 Study Materials
            </a>

            <a
                href="quiz.php?course=cyber"
                class="btn quiz-btn"
            >
                📝 Take Quiz
            </a>

        </div>


        <!-- Java -->

        <div class="course-card">

            <h2>☕ Java Programming</h2>

            <p>
                Learn Java programming, OOP concepts,
                classes, objects and basic applications.
            </p>

            <div class="info">
                <strong>Duration:</strong> 8 Weeks
            </div>

            <div class="info">
                <strong>Level:</strong> Beginner to Intermediate
            </div>

            <a
                href="lesson.php?course=java&lesson=1"
                class="btn"
            >
                📖 Study Materials
            </a>

        </div>


        <!-- C Programming -->

        <div class="course-card">

            <h2>💻 C Programming</h2>

            <p>
                Learn C programming fundamentals,
                variables, loops, functions and arrays.
            </p>

            <div class="info">
                <strong>Duration:</strong> 6 Weeks
            </div>

            <div class="info">
                <strong>Level:</strong> Beginner
            </div>

            <a
                href="lesson.php?course=c&lesson=1"
                class="btn"
            >
                📖 Study Materials
            </a>

        </div>


    </div>

</div>

</body>

</html>