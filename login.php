<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/style_login.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fondamento:ital@0;1&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
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
          <li><a href="about-pune.html">About Pune</a></li>
          <li><a href="about-committee.html">Organizing Committee</a></li>
        </ul>
      </div>
    </nav>
    <section class="banner"></section>

    <section class="heading">
      <h1>SignIn</h1>
      <p>Enter your email and password to proceed further</p>
      <p class="register">
        <b>Don’t have an account? <a href="register.php">Register now</a></b>
      </p>
    </section>

    <div class="Login-form">
      <form action="registration.php" method="post">
        <div class="email">
            <label for="email">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="  example@abc.com"
              required
            />
        </div>
        
        <div class="password">
            <label for="password">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="  ********"
              required
            />
        </div>
        <a href="forget-password.html">Forget Password?</a>
        <button type="submit" name="login">Login</button>
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
