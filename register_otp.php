<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OTP Authentication</title>
    <link rel="stylesheet" href="css/style_register_otp.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Fondamento:ital@0;1&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>

<body>
    <div class="top-banner">
        <img src="img/frame.png" alt="Host Logos" />
    </div>

    <header id="header">
        <div class="container">
            <div id="logo" class="pull-left">
                <a href="index.php"><img src="img/logo.png" alt="FogDew2026"></a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="index.php">Home</a></li>
                    <li class="menu-has-children">
                        <a href="#">About &nbsp<i class="fa-solid fa-caret-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="about-pune.html">About Pune</a></li>
                            <li><a href="about-iitm.html">About IITM</a></li>
                            <li><a href="about-committee.html">Organizing Committee</a></li>
                            <li><a href="https://ews.tropmet.res.in/wifex/aboutUs.php">WiFEx</a></li>
                        </ul>
                    </li>
                    <li class="menu-has-children">
                        <a href="#">Conference &nbsp<i class="fa-solid fa-caret-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="#poster">Poster</a></li>
                            <li><a href="index.php.#schedule">Schedule</a></li>
                            <li><a href="key-dates.html">Key Dates</a></li>
                            <li><a href="index.php.#venue">Venue</a></li>
                            <li><a href="index.php.#sponsors">Sponsors</a></li>
                        </ul>
                    </li>

                    <li class="menu-has-children">
            <a href="#">Travel, Stay & Visa &nbsp<i
                    class="fa-solid fa-caret-down"
                  ></i></a>
            <ul class="dropdown">
              <li><a href="accommodation.html">Accommodation</a></li>
              <li><a href="travel.html">Travel</a></li>
              <li><a href="Visa.html" >Visa</a></li>
            </ul>
          </li>

                    <li><a href="index.php.#contact">Contact</a></li>
                    <li class="Registration">
                        <a href="register.php">Registration</a>
                    </li>
                    <li class="Abstract">
                        <a href="abstract-submission.html">Abstract Submission</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

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