<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Form</title>

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
    <form action="registration.php" method="post" enctype="multipart/form-data" id="registrationForm">
      <h2>Personal Info</h2>

      <div class="name-email">
        <div class="name">
          <label for="name">Full Name</label><br />
          <input
            type="text"
            id="name"
            name="name"
            placeholder="  Eg.John Parker" required />
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
        <div class="phone">
          <label for="phone">Phone Number</label><br />
          <input
            type="tel"
            id="phone"
            name="phone"
            placeholder="  0123456789"
            required />
        </div>
      </div>


      <div class="gender-diet-allergy">
        <div class="gender">
          <label for="gender">Gender</label>
          <div>
            <input type="radio" id="male" name="gender" value="male" required />
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" required />
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="other" required />
            <label for="other">Other</label>
          </div>
        </div>
        <div class="diet">
          <label for="diet">Diet</label>
          <div>
            <input type="radio" id="veg" name="diet" value="veg" required />
            <label for="veg">Veg</label>
            <input type="radio" id="non-veg" name="diet" value="non-veg" required />
            <label for="non-veg">Non-Veg</label>
          </div>
        </div>
        <div class="allergy">
          <label for="allergy">Food Allergy</label>
          <div>
            <input type="radio" id="allergy-yes" name="allergy" value="yes" required />
            <label for="allergy-yes">Yes</label>
            <input type="radio" id="allergy-no" name="allergy" value="no" required />
            <label for="allergy-no">No</label>
          </div>
        </div>
      </div>
      <br>

      <h2>Affilation & Oraganization Info</h2>
      <div class="affilation-section">
        <div class="affiliation">
          <label for="as_a">Register Yourself as</label>
          <div>
            <input type="radio" id="student" name="as_a" value="student" required />
            <label for="student">Student</label>
            <input type="radio" id="delegates" name="as_a" value="delegates" required />
            <label for="delegates">Delegates</label>
          </div>
        </div>

        <div class="endorsement">
          <label for="endorsement">Endorsement Letter from your guide / Institute (PDF Only)</label>
          <div>
            <input type="file" id="endorsement" name="endorsement" />
          </div>
        </div>

        <div class="institute">
          <div class="institute_name_address">
            <div class="institute_name">
              <label for="institute">Affliation / Institute Name</label><br />
              <input
                type="text"
                id="institute_name"
                name="institute_name"
                placeholder="  Eg.IITM" required />
            </div>
            <div class="institute_address">
              <label for="institute">Affliation / Institute Address</label><br />
              <input
                type="text"
                id="institute_address"
                name="institute_address"
                placeholder="  Eg.123 Main St, City, Country" required />
            </div>
          </div>

          <div class="designation_country">
            <div class="designation">
              <label for="designation">Designation</label><br />
              <input
                type="text"
                id="designation"
                name="designation"
                placeholder="  Eg.Professor" required />
            </div>
            <div class="country">
              <label for="country">Country</label><br />
              <input
                type="text"
                id="country"
                name="country"
                placeholder="  Eg.India" required />
            </div>
          </div>
        </div>
      </div>

      <br>

      <h2>Login Credential Setup</h2>
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
        <input type="checkbox" name="chkbxpolicy" id="chkbxpolicy" required />
        I have read the <span>cancellation policy</span>
      </div>
      <br />
      <button type="submit" name="register" id="sendVerification">Send Email for OTP!</button>
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
  <!-- <script>
    const submitButton = document.getElementById("sendVerification");
    const otpSection = document.querySelector(".otpverify");
    const form = document.querySelector("form");
    submitButton.addEventListener("click", function(event) {
      if (form.checkValidity()) {
        otpSection.style.display = "block";
        otpInput.setAttribute("required", "required");
        alert("OTP Sent to your Email!");
      }
    });
  </script> -->
</body>

</html>