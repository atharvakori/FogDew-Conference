<?php
include 'connect.php';

require "./PHPMailer-master/src/PHPMailer.php";
require "./PHPMailer-master/src/SMTP.php";
require "./PHPMailer-master/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

session_start();

$fullname = $_POST['name'];
$email = $_POST['email'];
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
}

$verification_otp = random_int(100000, 999999);
$_SESSION['otp'] = $verification_otp;
$_SESSION['form_data'] = $_POST;

if (isset($_POST['register'])) {

    function sendMail($send_to, $otp, $name) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        // Enter your email ID
        $mail->Username = "atharva.kori7@gmail.com";
        $mail->Password = "pemamdjcgrsetfxv";
    
        // Your email ID and Email Title
        $mail->setFrom("atharva.kori7@gmail.com", "FogDew");
    
        $mail->addAddress($send_to);
    
        // You can change the subject according to your requirement!
        $mail->Subject = "Account Activation";
    
        // You can change the Body Message according to your requirement!
        $mail->Body = "Hello, {$name}\nYour account registration is successfully done! Now activate your account with OTP {$otp}.";
        $mail->send();
    }
    
    sendMail($email, $verification_otp, $fullname);
}

$input_otp = $_POST['otp'];

if (isset($_POST['otp_verified'])) {
    if($input_otp == $verification_otp) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    
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
    else {
        echo "Invalid OTP!";
    }
}

if (isset($_POST['login'])) {
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