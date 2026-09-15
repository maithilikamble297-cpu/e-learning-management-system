<?php

session_start();

include "config/db.php";

$message = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Find user by email
    $stmt = mysqli_prepare(
        $conn,
        "SELECT id, name, email, password, role
         FROM users
         WHERE email = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {

            // Create session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();

        } else {

            $message = "Invalid email or password!";

        }

    } else {

        $message = "Invalid email or password!";

    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Login</title>

    <link rel="stylesheet" href="css/style.css">

    <style>

        .login-container {
            width: 400px;
            max-width: 90%;
            margin: 70px auto;
            background: white;
            padding: 35px;
            border-radius: 10px;

            box-shadow:
                0 4px 15px rgba(0,0,0,0.15);
        }

        .login-container h2 {
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 25px;
        }

        .login-container label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        .login-container input {
            width: 100%;
            padding: 12px;

            border: 1px solid #ccc;
            border-radius: 5px;

            font-size: 15px;
        }

        .login-btn {
            width: 100%;

            margin-top: 25px;
            padding: 12px;

            border: none;
            border-radius: 5px;

            background-color: #1e3a8a;
            color: white;

            font-size: 16px;
            cursor: pointer;
        }

        .login-btn:hover {
            background-color: #2563eb;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;

            color: #dc2626;
            font-weight: bold;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

    </style>

</head>


<body>


<!-- Navigation Bar -->

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
            <a href="login.php">Login</a>
        </li>

        <li>
            <a href="register.php">Register</a>
        </li>

    </ul>

</nav>



<!-- Login Form -->

<div class="login-container">

    <h2>Student Login</h2>


    <?php if ($message != "") { ?>

        <div class="message">
            <?php echo htmlspecialchars($message); ?>
        </div>

    <?php } ?>


    <form method="POST" action="">


        <label>Email</label>

        <input
            type="email"
            name="email"
            placeholder="Enter your email"
            required
        >


        <label>Password</label>

        <input
            type="password"
            name="password"
            placeholder="Enter your password"
            required
        >


        <button
            type="submit"
            name="login"
            class="login-btn"
        >
            Login
        </button>


    </form>


    <div class="register-link">

        Don't have an account?

        <a href="register.php">
            Register Now
        </a>

    </div>

</div>



<!-- Footer -->

<footer>

    <p>
        © 2026 E-Learning Management System
    </p>

</footer>


</body>

</html>

