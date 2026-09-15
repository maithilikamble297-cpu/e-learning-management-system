<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include "config/db.php";

$user_id = $_SESSION["user_id"];

$course = $_POST["course"] ?? "";
$score = isset($_POST["score"]) ? (int)$_POST["score"] : 0;
$total = isset($_POST["total"]) ? (int)$_POST["total"] : 0;

if ($total <= 0) {
    die("Invalid quiz total.");
}

$percentage = ($score / $total) * 100;

$sql = "INSERT INTO quiz_results 
        (user_id, course, score, total, percentage)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare Error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "isiid",
    $user_id,
    $course,
    $score,
    $total,
    $percentage
);

if (mysqli_stmt_execute($stmt)) {
    echo "<h2>Quiz Submitted Successfully!</h2>";
    echo "<p>Course: " . htmlspecialchars($course) . "</p>";
    echo "<p>Score: " . $score . " / " . $total . "</p>";
    echo "<p>Percentage: " . number_format($percentage, 2) . "%</p>";

    echo '<br>';
    echo '<a href="dashboard.php">Go to Dashboard</a>';
} else {
    die("Database Error: " . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>