<?php
session_start();
include 'connect.php';

// Check if form is submitted
if (isset($_POST['submit_abstract'])) {
    // Collect form data
    $title = $_POST['title'];
    $authors = $_POST['authors'];
    $affiliation = $_POST['affiliation'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];
    $abstract_text = $_POST['abstract_text'];
    $keywords = $_POST['keywords'];

    // File upload handling
    $file_name = "";
    if (!empty($_FILES["abstract_file"]["name"])) {
        $target_dir = "upload/abstracts/";

        // Create directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = $_FILES["abstract_file"]["name"];
        $file_tmp = $_FILES["abstract_file"]["tmp_name"];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Only allow PDF files
        if ($file_type != "pdf" && $file_type != "doc" && $file_type != "docx") {
            $error_message = "Only PDF, DOC, and DOCX files are allowed!";
        } else {
            $new_file_name = time() . "_" . uniqid() . "." . $file_type;
            $file_path = $target_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $file_path)) {
                $file_name = $file_path;
            } else {
                $error_message = "File upload failed!";
            }
        }
    }

    // Insert data into database if no errors
    if (!isset($error_message)) {
        $submission_date = date("Y-m-d H:i:s");

        $sql = "INSERT INTO abstract_submissions (title, authors, affiliation, email, phone, category, abstract_text, keywords, file_path, submission_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $title, $authors, $affiliation, $email, $phone, $category, $abstract_text, $keywords, $file_name, $submission_date);

        if ($stmt->execute()) {
            $success_message = "Abstract submitted successfully!";
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Abstract Submission</title>
    <link rel="stylesheet" href="css/style-abstract-main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fondamento:ital@0;1&family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
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
                <li><a href="key-dates.html" >Key Dates</a></li>
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
              <a href="register.php" >Registration</a>
            </li>
            <li class="Abstract">
              <a href="abstract-submission.html" >Abstract Submission</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <!-- Abstract Submission Form Section -->
    <section class="abstract-form-section">
      <div class="container-form">
        <h1>Abstract Submission</h1>

        <?php if(isset($success_message)): ?>
          <div class="alert alert-success">
            <?php echo $success_message; ?>
          </div>
        <?php endif; ?>

        <?php if(isset($error_message)): ?>
          <div class="alert alert-danger">
            <?php echo $error_message; ?>
          </div>
        <?php endif; ?>

        <div class="abstract-guidelines">
          <h2>Guidelines for Abstract Submission</h2>
          <ul>
            <li>Abstract should be limited to 300 words.</li>
            <li>Include 3-5 keywords related to your research.</li>
            <li>File uploads should be in PDF, DOC, or DOCX format.</li>
            <li>All fields marked with an asterisk (*) are mandatory.</li>
            <li>The official language of the conference is English.</li>
          </ul>
        </div>

        <form action="" method="POST" enctype="multipart/form-data" class="abstract-form">
          <div class="form-group">
            <label for="title">Abstract Title *</label>
            <input type="text" id="title" name="title" required>
          </div>

          <div class="form-group">
            <label for="authors">Authors *</label>
            <input type="text" id="authors" name="authors" placeholder="Format: First Author, Second Author, etc." required>
          </div>

          <div class="form-group">
            <label for="affiliation">Affiliation *</label>
            <input type="text" id="affiliation" name="affiliation" required>
          </div>

          <div class="form-group">
            <label for="email">Contact Email *</label>
            <input type="email" id="email" name="email" required>
          </div>

          <div class="form-group">
            <label for="phone">Contact Phone</label>
            <input type="tel" id="phone" name="phone">
          </div>

          <div class="form-group">
            <label for="category">Category *</label>
            <select id="category" name="category" required>
              <option value="">Select a category</option>
              <option value="Fog Physics">Fog Physics</option>
              <option value="Fog Chemistry">Fog Chemistry</option>
              <option value="Fog Modeling">Fog Modeling</option>
              <option value="Fog Forecasting">Fog Forecasting</option>
              <option value="Fog Impacts">Fog Impacts</option>
              <option value="Fog Mitigation">Fog Mitigation</option>
              <option value="Dew Research">Dew Research</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="form-group">
            <label for="abstract_text">Abstract Text *</label>
            <textarea id="abstract_text" name="abstract_text" rows="8" maxlength="2000" required></textarea>
            <small>Maximum 300 words</small>
          </div>

          <div class="form-group">
            <label for="keywords">Keywords *</label>
            <input type="text" id="keywords" name="keywords" placeholder="Keyword1, Keyword2, Keyword3" required>
          </div>

          <div class="form-group">
            <label for="abstract_file">Upload Full Abstract (PDF, DOC, DOCX)</label>
            <input type="file" id="abstract_file" name="abstract_file" accept=".pdf,.doc,.docx">
          </div>

          <div class="form-group form-check">
            <input type="checkbox" id="terms" name="terms" required>
            <label for="terms">I agree that the submitted abstract complies with all the guidelines and can be published in the conference proceedings *</label>
          </div>

          <div class="form-group">
            <button type="submit" name="submit_abstract" class="submit-btn">Submit Abstract</button>
          </div>
        </form>
      </div>
    </section>

    <footer>
      <div>
        <p>
          &copy; www.fogdew2026.com. All Rights Reserved. | Developed By Atharva Kori
        </p>
      </div>
    </footer>

    <script>
      // Character counter for abstract text
      document.getElementById('abstract_text').addEventListener('input', function() {
        const maxWords = 300;
        const words = this.value.match(/\S+/g) || [];
        const wordCount = words.length;

        if (wordCount > maxWords) {
          // Trim to max words
          this.value = words.slice(0, maxWords).join(' ');
        }

        document.querySelector('small').textContent = `${wordCount}/${maxWords} words`;
      });
    </script>
  </body>
</html>