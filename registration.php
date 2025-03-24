<?php
session_start();
error_reporting(0);
include 'connect.php';

require "./PHPMailer-master/src/PHPMailer.php";
require "./PHPMailer-master/src/SMTP.php";
require "./PHPMailer-master/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Function to send OTP using PHPMailer
function sendMail($send_to, $otp, $name)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 587;

        // Set your SMTP credentials
        $mail->Username   = "atharva.kori7@gmail.com";  // Change to your SMTP email address
        $mail->Password   = "pemamdjcgrsetfxv";     // Change to your SMTP email password

        // Set sender info
        $mail->setFrom("atharva.kori7@gmail.com", "FogDew");

        // Add recipient
        $mail->addAddress($send_to);

        // Email subject and body
        $mail->Subject = "Your OTP for FogDew Conference Registration";
        $mail->Body    = "Dear {$name},\n\nThank you for registering for the 10th International Conference on FogDew.\n\nTo complete your registration, please use the following One-Time Password (OTP) to verify your email address:\n\nOTP: {$otp}\n\nThis OTP is valid for a limited time. If you did not initiate this registration, please disregard this email.\n\nWe look forward to your participation!\n\nBest regards,\nFogDew Conference Team";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit();
    }
}

// Step 1: Registration form submission (OTP sending)
if (isset($_POST['register'])) {
    // Collect registration inputs
    $fullname          = $_POST['name'];
    $email             = $_POST['email'];
    $phoneNo           = $_POST['phone'];
    $password          = $_POST['password'];
    $confirm_password  = $_POST['confirm_password'];
    $gender            = $_POST['gender'];
    $diet              = $_POST['diet'];
    $allergy           = $_POST['allergy'];
    $as_a              = $_POST['as_a'];
    $institute_name    = $_POST['institute_name'];
    $institute_address = $_POST['institute_address'];
    $designation       = $_POST['designation'];
    $country           = $_POST['country'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Process file upload for endorsement if provided
    $endorsement_file = "";
    if (!empty($_FILES["endorsement"]["name"])) {
        $target_dir = "upload/";
        $file_name  = $_FILES["endorsement"]["name"];
        $file_tmp   = $_FILES["endorsement"]["tmp_name"];
        $file_type  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Only allow PDF files
        if ($file_type != "pdf") {
            echo "Only PDF files are allowed!";
            exit();
        }

        // Rename file to prevent duplicates
        $new_file_name   = time() . "_" . uniqid() . "." . $file_type;
        $endorsement_file = $target_dir . $new_file_name;

        // Move uploaded file
        if (!move_uploaded_file($file_tmp, $endorsement_file)) {
            echo "File upload failed!";
            exit();
        }
    }

    // Check if the email is already registered
    $checkEmail = "SELECT * FROM registration WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        echo "Account already exists!";
        exit();
    }

    // Generate a 6-digit OTP using random_int
    $verification_otp = random_int(100000, 999999);

    // Store registration data and OTP in session
    $_SESSION['registration_data'] = array(
        'full_name'           => $fullname,
        'email'               => $email,
        'phone_no'            => $phoneNo,
        'gender'              => $gender,
        'diet'                => $diet,
        'allergy'             => $allergy,
        'student_or_delegates' => $as_a,
        'endorsement_file'    => $endorsement_file,
        'institute_name'      => $institute_name,
        'institute_address'   => $institute_address,
        'designation'         => $designation,
        'country'             => $country,
        'password'            => $password_hashed
    );
    $_SESSION['otp'] = $verification_otp;

    // Send the OTP using PHPMailer
    sendMail($email, $verification_otp, $fullname);

    // echo "OTP has been sent to your email. Please enter the OTP to complete registration.";
    // exit();
    header("Location: hello.html");
}

// Step 2: OTP verification and final registration insertion
if (isset($_POST['otp_verified'])) {
    if (!isset($_SESSION['otp']) || !isset($_SESSION['registration_data'])) {
        echo "Session expired. Please register again.";
        exit();
    }

    $entered_otp = $_POST['otp'];

    if ($entered_otp == $_SESSION['otp']) {
        // OTP is correct; retrieve registration data from session
        $data = $_SESSION['registration_data'];
        $insertQuery = "INSERT INTO registration (full_name, email, phone_no, gender, diet, allergy, student_or_delegates, endorsement_file, institute_name, institute_address, designation, country, password) 
                        VALUES ('" . $data['full_name'] . "', '" . $data['email'] . "', '" . $data['phone_no'] . "', '" . $data['gender'] . "', '" . $data['diet'] . "', '" . $data['allergy'] . "', '" . $data['student_or_delegates'] . "', '" . $data['endorsement_file'] . "', '" . $data['institute_name'] . "', '" . $data['institute_address'] . "', '" . $data['designation'] . "', '" . $data['country'] . "', '" . $data['password'] . "')";

        if ($conn->query($insertQuery) === TRUE) {
            // Clear session data and OTP after successful registration
            unset($_SESSION['registration_data']);
            unset($_SESSION['otp']);
            header("Location: index.html");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
