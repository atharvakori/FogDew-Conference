<?php
session_start();
include 'connect.php';

require "lib/PHPMailer-master/src/PHPMailer.php";
require "lib/PHPMailer-master/src/SMTP.php";
require "lib/PHPMailer-master/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


if (isset($_POST['register'])) {
    $fullname = $_POST['name']; // full_name of participant
    $email = $_POST['email']; // send_to_email
    $phoneNo = $_POST['phone'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $diet = $_POST['diet'];
    $allergy = $_POST['allergy'];
    $as_a = $_POST['as_a'];
    $institute_name = $_POST['institute_name'];
    $institute_address = $_POST['institute_address'];
    $designation = $_POST['designation'];
    $country = $_POST['country'];

    if ($password !== $_POST['confirm_password']) {
        echo "Passwords do not match!";
        exit;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    
    $endorsement_file = "";
    if (!empty($_FILES["endorsement"]["name"])) {
        $target_dir = "upload/";
        $file_name = $_FILES["endorsement"]["name"];
        $file_tmp = $_FILES["endorsement"]["tmp_name"];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validate File Type (Only PDF Allowed)
        if ($file_type != "pdf") {
            echo "Only PDF files are allowed!";
            exit();
        }

        // Rename File to Prevent Duplicates
        $new_file_name = time() . "_" . uniqid() . "." . $file_type;
        $endorsement_file = $target_dir . $new_file_name;

        // Move File to "upload/" Folder
        if (!move_uploaded_file($file_tmp, $endorsement_file)) {
            echo "File upload failed!";
            exit();
        }

        $verification_otp = random_int(100000, 999999);

        function sendMail($send_to, $otp, $name) {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
        
            $mail->Username = "atharva.kori23@pccoepune.org";
            $mail->Password   = '@thPccoe77';
        
            $mail->setFrom("atharva.kori23@pccoepune.org", "FogDew Conference Registration");
        
            $mail->addAddress($send_to);
        
            $mail->Subject = "Account Verification for Conference Registration";
        
            $mail->Body = "Hello, {$name}\nYour account registration is successfully done! Now activate your account with OTP {$otp}.";
            $mail->send();
        }
        
        sendMail($email, $verification_otp, $fullname);

        echo "Email Sent Successfully!";
    }
    
    $checkEmail = "SELECT * FROM registration WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        echo "Account already Exists !";
    } else {
        $insertQuery = "INSERT INTO registration (full_name, email, phone_no, gender, diet, allergy, student_or_delegates, endorsement_file, institute_name, institute_address, designation, country, password) 
                        VALUES ('$fullname', '$email', '$phoneNo', '$gender', '$diet', '$allergy', '$as_a', '$endorsement_file', '$institute_name', '$institute_address', '$designation', '$country', '$password')";
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
