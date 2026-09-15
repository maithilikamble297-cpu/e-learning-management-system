<?php

include "config/db.php";

$name = "Admin";
$email = "admin@gmail.com";
$password = "admin123";

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare(
    $conn,
    "SELECT id FROM users WHERE email = ?"
);

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {

    $user = mysqli_fetch_assoc($result);
    $id = $user["id"];

    $update = mysqli_prepare(
        $conn,
        "UPDATE users
         SET name = ?, password = ?, role = 'admin'
         WHERE id = ?"
    );

    mysqli_stmt_bind_param(
        $update,
        "ssi",
        $name,
        $hashed_password,
        $id
    );

    if (mysqli_stmt_execute($update)) {
        echo "Admin account updated successfully!";
    } else {
        echo "Error updating admin.";
    }

    mysqli_stmt_close($update);

} else {

    $insert = mysqli_prepare(
        $conn,
        "INSERT INTO users (name, email, password, role)
         VALUES (?, ?, ?, 'admin')"
    );

    mysqli_stmt_bind_param(
        $insert,
        "sss",
        $name,
        $email,
        $hashed_password
    );

    if (mysqli_stmt_execute($insert)) {
        echo "Admin account created successfully!";
    } else {
        echo "Error creating admin: " . mysqli_error($conn);
    }

    mysqli_stmt_close($insert);
}

mysqli_stmt_close($stmt);

?>