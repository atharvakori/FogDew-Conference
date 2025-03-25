<?php

include 'connect.php';
$token = $_POST['token'];
$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM registration WHERE reset_token_hash = ?";
$smt = $conn->prepare($sql);
$smt->bind_param("s", $token_hash);
$smt->execute();
$result = $smt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    echo "Invalid token";
    exit();
}

if (strtotime($user['rest_token_expires_at']) <= time()) {
    echo "Token expired";
    exit();
}

// if (strlen($_POST["password"]) < 8) {
//     die("Password must be at least 8 characters");
// }

// if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
//     die("Password must contain at least one letter");
// }

// if ( ! preg_match("/[0-9]/", $_POST["password"])) {
//     die("Password must contain at least one number");
// }

// if ($_POST["password"] !== $_POST["confirm_password"]) {
//     die("Passwords must match");
// }

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE registration SET password = ?, reset_token_hash = NULL, rest_token_expires_at = NULL WHERE id = ?";
$smt = $conn->prepare($sql);
$smt->bind_param("si", $password_hash, $user['id']);
$smt->execute();
echo "Password reset successfully";
?>
