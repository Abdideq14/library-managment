<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Library System</title>
	<link rel="icon" type="image/png" href="../images\image.png"/>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<header>
		<img src="../images/logo.png" alt="" style="width: 60px;">
		<nav>
		  <ul>
			<li><a href="#">Home</a></li>
			<li><a href="#e-books">E-Books</a></li>
			<li><a href="#search-catalog">Search catalog</a></li>
			<li><a href="#sec-3">Borrow book</a></li>
			<li><a href="#sec-3">Reserve</a></li>
			<li><a href="#sec-3">Return</a></li>
			<li><a href="#news">Library News</a></li>
			<li><a href="#">My account</a></li>
			<li><a href=""><i class="fa fa-shopping-cart" style="color:white; font-size:32px"></i></li></a>
			<li>
		  </ul>
		</nav>
	  </header>
	<main>
		<div id="top-img">
			<h1 id="welcometxt">Welcome back to Adan's online library <br> happy reading!</h1>
			<img src="../images/top-img-removebg-preview.png" alt="" id="welcome-img">			
		</div>

		<section id="browse-msg">
            <h1 id="browse-txt">Browse your next read in our online school library <br> today!</h1>
			<button id="btn-show">Show All</button>
        </section>

		<div class="container" id="e-books">
			<div class="cards-container">
			  <div class="card">
				<img src="../images/python.jpg" alt="Card 1">
				<h3>Python</h3>
				<p>Elliot Turner</p>
				<button id="btn-content">Add to cart</button>
			  </div>
			  <div class="card">
				<img src="../images/book2.jpg" alt="Card 2">
				<h3>Romeo and Juliet</h3>
				<p>william shakespeare</p>
				<button id="btn-content">Add to cart</button>

			  </div>
			  <div class="card">
				<img src="../images/book3.jpg" alt="Card 3">
				<h3>Room with view</h3>
				<p>E.M.Forster</p>
				<button id="btn-content">Add to cart</button>

			  </div>
			  <div class="card">
				<img src="../images/book4.jpg" alt="Card 4">
				<h3>Middlemarch</h3>
				<p>Goerge Elliot</p>
				<button id="btn-content">Add to cart</button>

			  </div>
			  <div class="card">
				<img src="../images/book5.jpg" alt="Card 5">
				<h3>Great Expectation</h3>
				<p>Charles Dickens</p>
				<button id="btn-content">Add to cart</button>
			  </div>
			  <div class="card">
				<img src="../images/ai.jpg" alt="Card 5">
				<h3>Artificial&nbsp;Intelligence</h3>
				<p>Tom Taulli</p>
				<button id="btn-content">Add to cart</button>
			  </div>
			</div>
			<button class="scroll-button prev" onclick="scrollCards(-1)">&lt;</button>
			<button class="scroll-button next" onclick="scrollCards(1)">&gt;</button>
		  </div>
		  


		<section id="search-catalog">
			<div id="search-card">
			<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['keywords']) || isset($_GET['author']) || isset($_GET['title']) || isset($_GET['isbn'])) {
    $keywords = $_GET['keywords'];
    $author = $_GET['author'];
    $title = $_GET['title'];
    $isbn = $_GET['isbn'];

    $sql = "SELECT * FROM books WHERE 1=1";
    if (!empty($keywords)) {
        $sql .= " AND (title LIKE '%$keywords%' OR author LIKE '%$keywords%' OR isbn LIKE '%$keywords%')";
    }
    if (!empty($author)) {
        $sql .= " AND author LIKE '%$author%'";
    }
    if (!empty($title)) {
        $sql .= " AND title LIKE '%$title%'";
    }
    if (!empty($isbn)) {
        $first_two_digits = substr($isbn, 0, 2);
        $sql .= " AND (isbn = '$isbn' OR isbn LIKE '$first_two_digits%')";
    }

    $result = mysqli_query($conn, $sql);
    $searchResults = '';
    if (mysqli_num_rows($result) > 0) {
        $searchResults .= '<table>';
        $searchResults .= '<tr><th>Title</th><th>Author</th><th>ISBN</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults .= '<tr>';
            $searchResults .= '<td>' . $row['title'] . '</td>';
            $searchResults .= '<td>' . $row['author'] . '</td>';
            $searchResults .= '<td>' . $row['isbn'] . '</td>';
            $searchResults .= '</tr>';
        }
        $searchResults .= '</table>';
    } else {
        $searchResults .= '<p style="border:1px solid red;background-color:rgb(219, 159, 159);padding:10px align-item: center;height: 20px; text-margin-left: 10px; border-radius:3px;">No results found.</p>';
    }
    echo $searchResults;
}
?>
					<h2>Advanced search</h2>
					<form>
						<div class="search-form">
							<form>

							<span>
							  <input type="text" id="search-keywords" name="keywords" placeholder="Keyword">
							</span>
							<span>
							  <input type="text" id="search-author" name="author" placeholder="Author">
							</span>
							<span>
							  <input type="text" id="search-title" name="title" placeholder="Title">
							</span>
							<span>
							  <input type="text" id="search-isbn" name="isbn" placeholder="ISBN">
							</span>
							<span id="btn-submit"><input type="submit" value="Search"></span>
							</form>
						  </div>
						  
					</form>

			</div>
<section>
	<div class="borrow-request-popup">
	<form>
		<span class="close" class="cancel-btn">&times;</span>
		<div id="borrow-form">
			<input type="text" id="user-name" name="user-name" placeholder="User's Name" required>
			
			<input type="text" id="book-title" name="book-title" placeholder="Book Title" required>
		</div>
		<br>
		<div id="borrow-form">
			<input type="text" id="book-isbn" name="book-isbn" placeholder="Book ISBN" required>
		</div>
		<br>
	<form action="post" method="borrow-book">
		<div id="borrow-form">
			<label for="borrow-date">Borrow Date:</label>
			<input type="date" id="borrow-date" name="borrow-date" placeholder="borrow date" required>

			<label for="borrow-date">Return Date:</label>
			<input type="date" id="borrow-date" name="borrow-date" required>
		</div>
		<br>
		<input type="submit" value="Submit">
	</form>
	</div>

<!-- Reserve book popup -->
<div class="reserve-book-popup">
  <div class="popup-content">
    <span class="close-popup-btn">&times;</span>
    <h2>Reserve Book</h2>
    <form id="reserve">
      <input type="text" id="name" name="name" placeholder="Name" required>
      <br>
      <input type="email" id="email" name="email" placeholder="Email" required>
      <br>
      <input type="text" id="book-title" name="book-title" placeholder="Book title" required>
      <br>
	  <input type="text" id="book-isbn" name="isbn" placeholder="ISBN" required>
	  <br>
		<div><label for="reserve-date">Reserve Date:</label>
			&nbsp;
			<input type="date" id="reserve-date" name="reserve-date" placeholder="Reserve data" required>

		</div>
      <br>
	  <button type="submit" value="Reserve">Reserve</button>
    </form>
  </div>
</div>

</section>
		</section>

		<form action="">
		<div id="return-popup" class="popup">
  <h2>Return Book</h2>
  <form action="return-book.php" method="post">
    <input type="hidden" name="book_id" value="123"> <!-- Replace with actual book ID -->
    <div class="form-group">
      <label for="return-date">Return Date:</label>
      <input type="date" id="return-date" name="return_date" required>
    </div>
    <div class="form-group">
      <label for="condition">Book Condition:</label>
      <select id="condition" name="condition" required>
        <option value="">Select book condition</option>
        <option value="good">Good</option>
        <option value="fair">Fair</option>
        <option value="poor">Poor</option>
      </select>
    </div>
    <div class="form-group">
      <label for="comments">Comments:</label>
      <textarea id="comments" name="comments"></textarea>
    </div>
    <input type="submit" value="Return Book">
  </form>
</div>
<script>
	// Get the popup element
var popup = document.getElementById("popup");

// Get the button that opens the popup
var openBtn = document.getElementById("return-book-btn");

// Get the <span> element that closes the popup
var closeBtn = popup.querySelector(".close");

// When the user clicks the button, show the popup
openBtn.onclick = function() {
  popup.style.display = "block";
}

// When the user clicks on <span> (x), close the popup
closeBtn.onclick = function() {
  popup.style.display = "none";
}

// When the user clicks anywhere outside of the popup, close it
window.onclick = function(event) {
  if (event.target == popup) {
    popup.style.display = "none";
  }
}

</script>
		</form>
		<section id="sec-3">
			<div class="service" class="contacts">
				<img src="../images/book-request.png" alt="Book Icon" width="100", height="100" href="#borrow-request-btn">
				<h3><button class="btn-content" id="borrow-request-btn">Borrow Book</button></h3>
				<p>Request book online, await librarian approval.</p>
			  </div>
			  <div class="service">
				<img src="../images/reserve.png" alt="Reserve Icon" width="100", height="100">
				<button class="btn-content" id="reserve-book-btn">Reserve a book</button>
				<p>Reserve a book to make sure it's waiting for you when you arrive.</p>
			  </div>
			  <div class="service">
				<img src="../images/return-book.png" alt="Reading Icon" width="100", height="100">
				<button class="btn-content" id="retun-book-btn">Return a book</button>
				<p>To request to return a book, await librarian approval.</p>
			  </div>
		</section>

		  <section>
			<section id="news">
				<div class="news-img">
				</div>
			<div class="new-contain">
				<h2>News and Announcements</h2>
				<div class="new1">
					<img src="../images/newsicon.png" alt="">
					<p><a href=""> New books have arrived </a> at the library! Explore our latest <br>
						 additions across various genres and expand your reading list. <br>
						Come check them out today.</p>
				</div>
				<div class="new2">
					<img src="../images/newsicon.png" alt="">
					<p><a href=""><a href="">Online library closed for maintenance.</a> We'll be back soon! <br>
						 Thank you for your understanding.</a></p>
				</div>
				<div class="new3">
					<img src="../images/newsicon.png" alt="">
					<p>Attention students! <a href=""> Share your thoughts on the library <br>
						 system design and usage.</a> Click the feedback section and let <br>
						  us know your opinions. Your feedback matters!</p>
				</div>
			</div>
				

			  </section>
			  
			  <section id="feedback">
				<h2>GET IN TOUCH</h2>
				<form class="feedback-form">
				  <input type="text" id="name" placeholder="Name">
				  <input type="email" id="email" placeholder="Email">
				  <textarea id="message" placeholder="Message...."></textarea>
				  <button type="submit">Submit</button>
				</form>
			  </section>
			  
		  </section>
		  
	</main>




	<footer>
		<div>
			<h2>Our services</h2>
			<ul type="none">
				<li><a href="">Advance search</a></li>
				<li><a href="">E-books</a></li>
				<li><a href="">Reserve book</a></li>
				<li><a href="#borrow-request-btn">Borrow book</a></li>
				<li><a href="">OPAC</a></li>
				<li><a href="">Library news</a></li>
			</ul>
		</div>
		<div>
			<h2>Useful Links</h2>
			<ul type="none">
				<li><a href="https://secure.urkund.com/account/auth/login">Plagiarism Checker</a></li>
				<li><a href="https://www.coursera.org/">Google Coursera</a></li>
				<li><a href="#">University Clubs</a></li>
				<li><a href="#">Free Online Courses</a></li>
			</ul>
		</div>
	<ul>
		<H2>Contacts</H2>
		<li>
			<a href="adanhassan@gmail.com"><img src="../images/ig.png" alt="" style="width: 30px;"></a>
		</li>
		<li>
			<a href="adanhassan@gmail.com"><img src="../images/fb.png" alt="" style="width: 30px;"></a>

		</li>
	</ul>
		
    </footer>
	<div id="footer2">
		<p id="p1">&copy; Adan's Library System 2023. All right reserved</p>
	</div>
	<script src="script.js"></script>
	</body>
    </html>
		

