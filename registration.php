<?php
include 'connect.php';

if (isset($_POST['register'])) {
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
