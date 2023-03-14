<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'mydb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ISBN from the form
    $isbn = $_POST['isbn'];

    // Delete the book from the database
    $sql = "DELETE FROM books WHERE isbn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $isbn);
    $stmt->execute();

    // Check if the book was deleted
    if ($stmt->affected_rows === 1) {
        // Redirect back to the index page
        header('Location: index.php');
        exit();
    } else {
        // Show an error message
        echo "Error deleting book.";
    }
}

// Close the database connection
$conn->close();
?>
