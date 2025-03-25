<?php
include 'connect.php';
$email = $_POST['email'];
$token = bin2hex(random_bytes(16));
$hashedToken = hash("sha256", $token);
$expiry =  date("Y-m-d H:i:s", time() + 60 * 30);

$sql = "UPDATE registration SET reset_token_hash = ?, rest_token_expires_at = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $hashedToken, $expiry, $email);
$stmt->execute();

if($conn->affected_rows > 0){
    $mail = require __DIR__ . "/forget_pass_mailer.php";
    $mail->setFrom("atharva.kori7@gmail.com", "FogDew");
    $mail->addAddress($email);
    $mail->Subject = "Reset Password";
    $mail->Body = <<<END

    Click <a href="http://localhost/fogdew/reset_password_link.php?token=$token">here</a> to reset your password.
    END;
    try{
        $mail->send();
    }
    catch(Exception $e){
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit();
    }
}
echo "Check your email for password reset link";
?>