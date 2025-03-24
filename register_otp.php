<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Form</title>

    <link rel="stylesheet" href="css/style_register_otp.css" />

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

    <div class="otpverify" id="otpSection">
        <div class="inner">
            <form action="registration.php" method="post">
                <h2>Please check your email for OTP !</h2>
                <label for="otpInput">Enter OTP</label><br />
                <input
                    type="text"
                    id="otpInput"
                    name="otp"
                    placeholder="  Enter OTP sent to your email" /> <br>
                <button class="btn" name="otp_verified">verify & Save</button>
            </form>
        </div>
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