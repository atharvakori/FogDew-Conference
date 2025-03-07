<?php
include 'connect.php';

if (isset($_POST['register'])) {
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phone'];
    $password = $_POST['password'];

    if ($password !== $_POST['confirm_password']) {
        echo "Passwords do not match!";
        exit;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $checkEmail = "SELECT * FROM registration WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        echo "Account already Exists !";
    } else {
        $insertQuery = "INSERT INTO registration(full_name,email,phone_no,password) VALUES ('$fullname','$email', '$phoneNo', '$password')";
        if ($conn->query($insertQuery) == TRUE) {
            header("location: index.html");
        } else {
            echo "Error:" . $conn->error;
        }
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $verify = "SELECT * FROM registration WHERE email='$email'";
    $result = $conn->query($verify);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_hash = $row['password'];
        if (password_verify($password, $stored_hash)) {
            session_start();
            header("location: index.html");
            exit();
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "Enter correct credentials !";
    }
}
