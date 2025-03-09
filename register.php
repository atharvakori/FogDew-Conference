<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Form</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style_registration.css" />

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
  <section class="banner"></section>

  <section class="heading">
    <h1>Register Yourself...!</h1>
    <p>
      Secure your spot now by registering online and take the first step
      towards sharing your insights, inspiring future leaders, and engaging in
      dynamic discussions.
    </p>
    <p class="login">
      <b>Already registered? <a href="login.php">Login now</a></b>
    </p>
  </section>

  <div class="Registration_form">
    <form action="registration.php" method="post">
      <div class="name-email">
        <div class="name">
          <label for="name">Full Name</label><br />
          <input
            type="text"
            id="name"
            name="name"
            placeholder="  Eg.John Parker" />
        </div>
        <div class="email">
          <label for="email">Email</label><br />
          <input
            type="email"
            id="email"
            name="email"
            placeholder="  example@abc.com"
            required />
        </div>
        <div>
          <label for="phone">Phone Number</label><br />
          <input
            type="tel"
            id="phone"
            name="phone"
            placeholder="  0123456789"
            required />
        </div>
      </div>

      <div class="password">
        <div class="pass">
          <label for="password">Password</label><br />
          <input
            type="password"
            id="password"
            name="password"
            placeholder="  ********"
            required />
        </div>
        <div class="conf_pass">
          <label for="confirm_password">Confirm Password</label><br />
          <input
            type="password"
            id="confirm_password"
            name="confirm_password"
            placeholder="  ********"
            required />
        </div>
      </div>
      <br />
      <div class="chkbxpolicy">
        <input type="checkbox" name="chkbxpolicy" id="chkbxpolicy" />
        I have read the <span>cancellation policy</span>
      </div>
      <button type="submit" name="register">Send Verification Mail</button>
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

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>