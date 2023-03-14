<?php
// Connect to the database
$host = 'localhost';
$dbname = 'mydb';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];
try {
  $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
  die('Database connection failed: ' . $e->getMessage());
}

// Get the book ID from the URL parameter
if (!isset($_GET['book_id'])) {
  die('Book ID not specified');
}
$bookId = $_GET['book_id'];

// Check if the user is logged in
// Your implementation here
$userLoggedIn = true;
if (!$userLoggedIn) {
  // Redirect to the login page
  header('Location: ../landing/index.php');
  exit();
}

// Get the user's ID from the session or database
// Your implementation here
$userId = 1;

// Check if the user has any overdue books with penalties
$hasPenalties = false; // Your implementation here

// Check if the user has reached the maximum number of borrowed books
$stmt = $pdo->prepare('SELECT COUNT(*) FROM borrowings WHERE user_id = ?');
$stmt->execute([$userId]);
$numBorrowedBooks = $stmt->fetchColumn();
if ($numBorrowedBooks >= 2) {
  // Redirect to an error page
//   header('Location: error.php?message=Maximum number of borrowed books reached');
  echo '<script> alert"Maximum number of borrowed books reached" </script>';

  exit();
}

// Check if the user has already borrowed the book
$stmt = $pdo->prepare('SELECT * FROM borrowings WHERE user_id = ? AND book_id = ? AND returned_date IS NULL');
$stmt->execute([$userId, $bookId]);
$existingBorrowing = $stmt->fetch();
if ($existingBorrowing) {
  // Redirect to an error page
  echo '<script> alert"You have already borrowed this book" </script>';

  exit();
}

// Check if there are any available copies of the book
$stmt = $pdo->prepare('SELECT * FROM books WHERE id = ? AND copies_available > 0');
$stmt->execute([$bookId]);
$book = $stmt->fetch();
if (!$book) {
  // Redirect to a reservation page
  header("Location: client/reserve-popup.php?book_id=$bookId#reserve-book-btn");

//  header('Location: reserve.php?book_id=' . $bookId);
  exit();
}

// Borrow the book
$borrowDate = date('Y-m-d');
$returnDate = date('Y-m-d', strtotime('+1 week'));
$stmt = $pdo->prepare('INSERT INTO borrowings (user_id, book_id, borrow_date, return_date) VALUES (?, ?, ?, ?)');
$stmt->execute([$userId, $bookId, $borrowDate, $returnDate]);

// Update the copies available
$stmt = $pdo->prepare('UPDATE books SET copies_available = copies_available - 1 WHERE id = ?');
$stmt->execute([$bookId]);

// Redirect to a success page
echo '<script> alert"Book successfully borrowed" </script>';
exit();
?>
