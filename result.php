<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "config/db.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT course, score, total, percentage, created_at
        FROM quiz_results
        WHERE user_id = ?
        ORDER BY created_at DESC";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $user_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Results - E-Learning System</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .navbar {
            background: #1e3a8a;
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
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .container {
            width: 85%;
            margin: 50px auto;
        }

        h1 {
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 30px;
        }

        .table-container {
            background: white;
            padding: 25px;
            border-radius: 10px;

            box-shadow: 0 3px 10px rgba(0,0,0,0.1);

            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #1e3a8a;
            color: white;
        }

        .score {
            font-weight: bold;
        }

        .back-btn {
            display: inline-block;

            margin-top: 25px;

            background: #1e3a8a;
            color: white;

            padding: 11px 22px;

            text-decoration: none;
            border-radius: 5px;
        }

        .no-result {
            text-align: center;
            padding: 30px;
            color: #666;
        }

        footer {
            margin-top: 60px;
            background: #1e3a8a;
            color: white;
            text-align: center;
            padding: 20px;
        }

        @media (max-width: 700px) {

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                flex-direction: column;
                text-align: center;
            }

            .container {
                width: 95%;
            }

        }

    </style>

</head>

<body>


<nav class="navbar">

    <div class="logo">
        E-Learning System
    </div>

    <ul class="nav-links">

        <li>
            <a href="index.php">Home</a>
        </li>

        <li>
            <a href="dashboard.php">Dashboard</a>
        </li>

        <li>
            <a href="course.php">Courses</a>
        </li>

        <li>
            <a href="logout.php">Logout</a>
        </li>

    </ul>

</nav>


<div class="container">

    <h1>📊 My Quiz Results</h1>

    <div class="table-container">

        <?php if (mysqli_num_rows($result) > 0) { ?>

            <table>

                <tr>

                    <th>Course</th>

                    <th>Score</th>

                    <th>Total</th>

                    <th>Percentage</th>

                    <th>Date</th>

                </tr>


                <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            <?php
                            echo htmlspecialchars($row['course']);
                            ?>
                        </td>

                        <td class="score">

                            <?php
                            echo $row['score'];
                            ?>

                        </td>

                        <td>

                            <?php
                            echo $row['total'];
                            ?>

                        </td>

                        <td>

                            <?php
                            echo $row['percentage'];
                            ?>%

                        </td>

                        <td>

                            <?php
                            echo $row['created_at'];
                            ?>

                        </td>

                    </tr>

                <?php } ?>

            </table>

        <?php } else { ?>

            <div class="no-result">

                <h3>No Quiz Results Yet</h3>

                <p>
                    Complete a quiz to see your result here.
                </p>

            </div>

        <?php } ?>

    </div>


    <a href="course.php" class="back-btn">
        ← Back to Courses
    </a>

</div>


<footer>

    <p>
        © 2026 E-Learning Management System
    </p>

</footer>


</body>

</html>

<?php

mysqli_stmt_close($stmt);

?>