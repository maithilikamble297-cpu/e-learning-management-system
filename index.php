<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-Learning Management System</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        /* NAVBAR */

        .navbar {
            background: #2563eb;
            color: white;

            padding: 18px 50px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-size: 16px;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* HERO */

        .hero {
            background: linear-gradient(
                135deg,
                #172f62e8,
                #11245a
            );

            color: white;

            text-align: center;

            padding: 80px 20px;
        }

        .hero h1 {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 19px;
            max-width: 700px;
            margin: auto;
            line-height: 1.6;
        }

        .hero-buttons {
            margin-top: 30px;
        }

        .hero-btn {
            display: inline-block;

            padding: 13px 25px;

            margin: 8px;

            border-radius: 7px;

            text-decoration: none;

            font-weight: bold;
        }

        .register-btn {
            background: white;
            color: #2563eb;
        }

        .login-btn {
            border: 2px solid white;
            color: white;
        }

        /* POPULAR COURSES */

        .courses-section {
            padding: 60px 40px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 32px;
            color: #2563eb;
            margin-bottom: 10px;
        }

        .section-title p {
            color: #6b7280;
        }

        .courses-container {
            max-width: 1100px;
            margin: auto;

            display: grid;

            grid-template-columns:
                repeat(auto-fit, minmax(250px, 1fr));

            gap: 25px;
        }

        .course-card {
            background: white;

            padding: 25px;

            border-radius: 12px;

            box-shadow:
                0 4px 15px rgba(0,0,0,0.08);

            transition: 0.3s;

            text-align: center;
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .course-icon {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .course-card h3 {
            color: #2563eb;
            margin-bottom: 10px;
        }

        .course-card p {
            color: #6b7280;
            line-height: 1.5;
        }

        .course-btn {
            display: inline-block;

            margin-top: 15px;

            padding: 11px 20px;

            background: #2563eb;

            color: white;

            text-decoration: none;

            border-radius: 6px;
        }

        .course-btn:hover {
            background: #1d4ed8;
        }

        /* FEATURES */

        .features {
            background: white;
            padding: 60px 40px;
        }

        .features-container {
            max-width: 1100px;
            margin: auto;

            display: grid;

            grid-template-columns:
                repeat(auto-fit, minmax(220px, 1fr));

            gap: 25px;
        }

        .feature {
            text-align: center;
            padding: 20px;
        }

        .feature-icon {
            font-size: 40px;
        }

        .feature h3 {
            color: #2563eb;
        }

        .feature p {
            color: #6b7280;
        }

        /* FOOTER */

        footer {
            background: #111827;
            color: white;

            text-align: center;

            padding: 25px;

            margin-top: 0;
        }

    </style>

</head>


<body>


<!-- NAVBAR -->

<div class="navbar">

    <div class="logo">
        📚 E-Learning LMS
    </div>

    <div class="nav-links">

        <a href="index.php">Home</a>

        <?php if (isset($_SESSION['user_id'])) { ?>

            <a href="dashboard.php">Dashboard</a>

            <a href="course.php">Courses</a>

            <a href="profile.php">My Profile</a>

            <a href="logout.php">Logout</a>

        <?php } else { ?>

            <a href="register.php">Register</a>

            <a href="login.php">Login</a>

        <?php } ?>

    </div>

</div>


<!-- HERO SECTION -->

<section class="hero">

    <h1>
        Welcome to E-Learning LMS
    </h1>

    <p>
        Learn new skills, explore courses,
        study lessons and test your knowledge
        through online quizzes.
    </p>

    <div class="hero-buttons">

        <?php if (isset($_SESSION['user_id'])) { ?>

            <a href="course.php"
               class="hero-btn register-btn">
                View Courses
            </a>

            <a href="dashboard.php"
               class="hero-btn login-btn">
                Go to Dashboard
            </a>

        <?php } else { ?>

            <a href="register.php"
               class="hero-btn register-btn">
                Get Started
            </a>

            <a href="login.php"
               class="hero-btn login-btn">
                Student Login
            </a>

        <?php } ?>

    </div>

</section>


<!-- POPULAR COURSES -->

<section class="courses-section">

    <div class="section-title">

        <h2>
            Popular Courses
        </h2>

        <p>
            Explore our most popular learning courses
        </p>

    </div>


    <div class="courses-container">


        <!-- PYTHON -->

        <div class="course-card">

            <div class="course-icon">
                🐍
            </div>

            <h3>
                Python Programming
            </h3>

            <p>
                Learn Python programming
                from basics to advanced concepts.
            </p>

            <a
                href="course.php"
                class="course-btn"
            >
                View Course
            </a>

        </div>


        <!-- WEB DEVELOPMENT -->

        <div class="course-card">

            <div class="course-icon">
                🌐
            </div>

            <h3>
                Web Development
            </h3>

            <p>
                Learn HTML, CSS, PHP and
                web development concepts.
            </p>

            <a
                href="course.php"
                class="course-btn"
            >
                View Course
            </a>

        </div>


        <!-- DATABASE -->

        <div class="course-card">

            <div class="course-icon">
                🗄️
            </div>

            <h3>
                Database Management
            </h3>

            <p>
                Learn MySQL and database
                management concepts.
            </p>

            <a
                href="course.php"
                class="course-btn"
            >
                View Course
            </a>

        </div>


        <!-- CYBER SECURITY -->

        <div class="course-card">

            <div class="course-icon">
                🔐
            </div>

            <h3>
                Cyber Security
            </h3>

            <p>
                Learn basic cyber security
                and online safety concepts.
            </p>

            <a
                href="course.php"
                class="course-btn"
            >
                View Course
            </a>

        </div>


    </div>

</section>


<!-- FEATURES -->

<section class="features">

    <div class="section-title">

        <h2>
            Why Choose Our LMS?
        </h2>

    </div>


    <div class="features-container">


        <div class="feature">

            <div class="feature-icon">
                📖
            </div>

            <h3>
                Study Material
            </h3>

            <p>
                Access lessons and
                learning resources.
            </p>

        </div>


        <div class="feature">

            <div class="feature-icon">
                🎯
            </div>

            <h3>
                Online Quiz
            </h3>

            <p>
                Test your knowledge
                with online quizzes.
            </p>

        </div>


        <div class="feature">

            <div class="feature-icon">
                📊
            </div>

            <h3>
                Track Results
            </h3>

            <p>
                View your quiz scores
                and performance.
            </p>

        </div>


        <div class="feature">

            <div class="feature-icon">
                💻
            </div>

            <h3>
                Learn Anywhere
            </h3>

            <p>
                Study courses anytime
                from your computer.
            </p>

        </div>


    </div>

</section>


<!-- FOOTER -->

<footer>

    <p>
        © 2026 E-Learning Management System
    </p>

    <p>
        Developed using PHP, MySQL, HTML & CSS
    </p>

</footer>


</body>

</html>