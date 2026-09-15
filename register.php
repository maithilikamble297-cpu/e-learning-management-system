<?php

include "config/db.php";

$message = "";

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check password
    if ($password != $confirm_password) {

        $message = "Passwords do not match!";

    } else {

        // Check existing email
        $check = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($check, "s", $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {

            $message = "Email already registered!";

        } else {

            // Secure password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert student
            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO users (name, email, password, role)
                 VALUES (?, ?, ?, 'student')"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "sss",
                $name,
                $email,
                $hashed_password
            );

            if (mysqli_stmt_execute($stmt)) {

                $message = "Registration successful! You can login now.";

            } else {

                $message = "Registration failed!";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($check);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration</title>

    <link rel="stylesheet" href="css/style.css">

    <style>

        .register-container {
            width: 400px;
            max-width: 90%;
            margin: 60px auto;
            background: white;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .register-container h2 {
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 25px;
        }

        .register-container label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .register-container input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        .register-btn {
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

        .register-btn:hover {
            background-color: #2563eb;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            color: #1e3a8a;
            font-weight: bold;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

    </style>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar">

        <div class="logo">
            E-Learning System
        </div>

        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>

    </nav>


    <!-- Registration Form -->
    <div class="register-container">

        <h2>Student Registration</h2>

        <?php if ($message != "") { ?>

            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>

        <?php } ?>


        <form method="POST" action="">

            <label>Full Name</label>

            <input
                type="text"
                name="name"
                placeholder="Enter your full name"
                required
            >


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
                placeholder="Enter password"
                required
            >


            <label>Confirm Password</label>

            <input
                type="password"
                name="confirm_password"
                placeholder="Confirm password"
                required
            >


            <button
                type="submit"
                name="register"
                class="register-btn"
            >
                Register
            </button>

        </form>


        <div class="login-link">

            Already have an account?

            <a href="login.php">
                Login
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

