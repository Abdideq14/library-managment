<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'mydb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the update form was submitted
    if (isset($_POST["update"])) {
        // Get the updated book information from the form
        $isbn = $_POST["isbn"];
        $title = $_POST["title"];
        $author = $_POST["author"];
        $new_isbn = $_POST["new_isbn"];

        // Update the book in the database
        $sql = "UPDATE books SET isbn='$new_isbn', title='$title', author='$author' WHERE isbn='$isbn'";
        if ($conn->query($sql) === TRUE) {
          echo '<div class="success-box">Book updated successfully</div>';
        } else {
            echo "Error updating book: " . $conn->error;
        }
    } else {
        // Display the edit form for the selected book
        $isbn = $_POST["isbn"];
        $sql = "SELECT * FROM books WHERE isbn='$isbn'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
            echo "<h2>Edit Book</h2>";

            echo "<input type='hidden' name='isbn' value='" . $row["isbn"] . "'>";
            echo "Title: <input type='text' name='title' value='" . $row["title"] . "'><br>";
            echo "Author: <input type='text' name='author' value='" . $row["author"] . "'><br>";
            echo "New ISBN: <input type='text' name='new_isbn' value='" . $row["isbn"] . "'><br>";
            echo "<button type='submit' name='update'>Update</button>";
            echo "</form>";

            echo "<style>";
            echo "form { width: 400px; margin: 0 auto; padding: 30px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 2px 2px 10px #ccc; text-align: center; } 
            ";
            echo "label { display: block;}";
            echo "input[type=text] { padding: 5px; margin-bottom: 10px; border-radius:5px; width:70%;}";
            echo "button[type=submit] { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; width:80%;}";
            echo "</style>";
        } else {
            echo  '<script>alert "Book not found"</script>';
        }
    }
}

// Close the database connection
$conn->close();
?>
