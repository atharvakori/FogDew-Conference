<?php

include 'connect.php';
$token = $_GET['token'];
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Form</title>
    <link rel="stylesheet" href="css/style_reset_password_link.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Fondamento:ital@0;1&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="top-banner">
        <img src="img/frame.png" alt="Host Logos" />
    </div>

    <nav id="navbar">
        <div id="logo">
            <a href="index.html"><img src="img/logo.png" alt="FogDew2026" /></a>
        </div>
        <div id="menu">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about-iitm.html">About IITM</a></li>
                <li><a href="about-committee.html">Organizing Committee</a></li>
            </ul>
        </div>
    </nav>

    <div>
        <h1>Reset Password</h1>
        <form action="process_rest_password.php" method="POST">
            <input type="hidden" name="token" value="<?=htmlspecialchars($token) ?>" />
            <label for="password">New Password</label>
            <input type="password" name="password" id= "password" placeholder="New Password" required />
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id= "confirm_password" placeholder="Confirm Password" required />
            <button type="submit">Reset Password</button>
        </form>
    </div>
    <footer>
    <div>
        <p>
            &copy; www.fogdew2026.com. All Rights Reserved. | Developed By Atharva
            Kori
        </p>
    </div>
</footer>
</body>
</html>