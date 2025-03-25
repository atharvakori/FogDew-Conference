<?php
include 'connect.php';

if (isset($_POST['newsletter'])) {
    $email = $_POST['email'];
    $check_from_reg = "SELECT * FROM registration WHERE email='$email'"; // Check if the email is already registered in the registration table
    $check_from_news = "SELECT * FROM newsletter WHERE email='$email'"; // Check if the email is already registered in the newsletter table
    $result_reg = $conn->query($check_from_reg);
    $result_news = $conn->query($check_from_news);
    if ($result_reg->num_rows > 0 || $result_news->num_rows > 0) {
        echo "Account already exists!";
        exit();
    }
    $insertQuery = "INSERT INTO newsletter (email) VALUES ('$email')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Subscribed to newsletter!";
        exit();
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
        exit();
    }
}
