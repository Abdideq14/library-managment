<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
    <link rel="icon" type="image/png" href="../images\image.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../sign-up/signup.html">
  </head>

  <body>
    <header>
      
      <div class="container">
        <div>
          <p class="img-logo"></p>
          <h1 class="logo"> Adan's Library System</h1>
        </div>
       
       
        <nav>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#mission">Mission & Vision</a></li>
            <li><a href="#" id="to-popup">OPAC</a></li>
            <li><a href="#contacts">Contact</a></li>
            <li><a href="#" id="to-popup">Off-Campus Access</a></li>
            <li><a href="#" id="to-popup">Sign up</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'mydb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the login form is submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the credentials are found in the database
    $stmt = $conn->prepare("SELECT * FROM register WHERE (firstname = ? OR lastname = ? OR email = ?) AND password = ?");
    $stmt->bind_param("ssss", $username, $username, $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // The user is authenticated
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['email'];
        if ($_SESSION['username'] == 'adanhassan@zetech.ac.ke') {
            header("Location: ../admin/index.php");
        } else {
            header("Location: ../client/client.php");
        }
        exit();
    } else {
        // The credentials are invalid
        echo "<script>
            var errorMsg = document.createElement('div');
            errorMsg.classList.add('error-msg');
            errorMsg.innerText = 'Incorrect username or password. Please try again.';
            document.body.appendChild(errorMsg);
            document.addEventListener('click', function() {
                errorMsg.style.display = 'none';
            });
        </script>";
    }

    $stmt->close();
}

$conn->close();
?>

    
<!-- HTML Popup -->
<div id="loginPopup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <form method="post" action="#">
            <div>
                <h1>Login</h1>
            </div>
            <div class="form-group">
                <label for="username-email">Username or Email</label>
                <input type="text" name="username" id="username-email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            <label>
                <input type="checkbox" name="rememberMe" id="rememberMe"/> Remember Me
            </label>
            <button type="submit" name="login">Login</button>
            <p>Don't have an account? <a href="../sign-up\sign-up.php">Sign up</a></p>
        </form>
    </div>
</div>

<!-- CSS for error message -->
<style>

</style>


<section>
<div id="flex">
    <div class="right-sidebar" id="right-sidebar" >
        <h2>Library Services</h2>
        <hr>
        <a href="#" id="to-popup">Library Account</a>
        <hr>
        <a href="#" id="to-popup">Borrow Book</a>
        <hr>
        <a href="#" id="to-popup">News and Announcements</a>
        <hr>
        <a href="#" id="to-popup">Research Materials</a>
        <hr>
        <a href="#" id="to-popup">Community and Collections</a>
        <hr>
        <a href="#" id="to-popup">Digital Repositories</a>
      </div>

      <div>
        <img src="../images/library1.jpg" alt="">
      </div>
      
    <div class="left-sidebar">

    <aside>
        <div class="useful-links">
            <h2>Useful Links</h2>
            <hr>
            <ul type="none" text-decoration="none">
              <li><a href="https://secure.urkund.com/account/auth/login">Plagiarism Checker</a></li>
              <hr>
              <li><a href="https://www.coursera.org/">Google Coursera</a></li>
              <hr>
              <li><a href="#">University Clubs</a></li>
              <hr>
              <li><a href="#">Free Online Courses</a></li>
              <hr>
            </ul>
          </div>
          
      </aside>
  </div>
  <div id="top-img">
    <img src="../images/library1.jpeg" alt="" >
  </div>
</div>

    <section class="services">
      <div class="container">
        <h2 class="section-title">Our Services</h2>
        <div class="services-list">
          <div class="service" class="contacts">
            <img src="../images/books.png" alt="Book Icon" width="100", height="100">
            <h3>Online Catalog</h3>
            <p>Search our online catalog to find the books you need.</p>
          </div>
          <div class="service">
            <img src="../images/reserve.png" alt="Reserve Icon" width="100", height="100">
            <h3>Reserve a Book</h3>
            <p>Reserve a book to make sure it's waiting for you when you arrive.</p>
          </div>
          <div class="service">
            <img src="../images/reading.png" alt="Reading Icon" width="100", height="100">
            <h3>Reading Room</h3>
            <p>Enjoy a quiet space to read and study in our reading room.</p>
          </div>
        </div>
      </div>
    </section>


    <div id="mission">    
      <div class="img2">
        <img src="../images/library2.jpeg" alt="" style="width:600px;">
      </div>
      <div class="mission-statement">
        <h3>Mission</h3>
        <p>To support the educational, research, and cultural needs of the university community by providing access to a comprehensive collection of resources, fostering intellectual discovery, and creating an inclusive and welcoming environment for all patrons.</p>
      </div>
    </div>
    <div id="vision">    
      <div class="vision-statement">
        <h3>Vision</h3>
        <p>To be a leading academic library that supports the university's mission of advancing knowledge through teaching, research, and service by providing innovative services, technologies, and spaces that enhance learning and scholarship.</p>
      </div>
      <div class="img3">
        <img src="../images/library3.jpeg" alt="" style="width: 630px;">
      </div>
    </div>
    
    <footer>
      <div class="container">
        <p>&copy; Library System 2023. All right reserved</p>
      </div>
      <div>
        <div class="contacts" id="contacts">
          <a href="#" class="fa fa-facebook"><img src="../images/fb.png" alt=""></a>
          <a href="#" class="fa fa-twitter"><img src="../images/twiter.png" alt=""></a>
          <a href="#" class="fa fa-instagram"><img src="../images/ig.png" alt=""></a>
        </div>  
    </footer>
<script src="index.js"></script>

  </body>
</html>
