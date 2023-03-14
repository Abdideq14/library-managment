<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add book</title>
    <link rel="stylesheet" href="addbook.css">
</head>
<body>
<?php
// Set database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the book details from the form submission
    $title = $_POST['title'];
    $isbn = $_POST['isbn'];
    $author = $_POST['author'];
    $copies = $_POST['copies'];

    // Check if the book already exists in the database
    $check_sql = "SELECT * FROM books WHERE title = '$title'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $message = "Book already exists in the database";
        echo "<script>
            var errorMsg = document.createElement('div');
            errorMsg.classList.add('error-msg');
            errorMsg.innerText = '$message';
            document.body.appendChild(errorMsg);
            document.addEventListener('click', function() {
                errorMsg.style.display = 'none';
            });
        </script>";
    } else {
        // Prepare the insert query
        $sql = "INSERT INTO books (title, isbn, author, copies) VALUES ('$title', $isbn, '$author', $copies)";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            $message = "Book added successfully";
            echo "<script>
            var successMsg = document.createElement('div');
            successMsg.classList.add('success-msg');
            successMsg.innerText = '$message';
            document.body.appendChild(successMsg);
            document.addEventListener('click', function() {
                successMsg.style.display = 'none';
            });
            </script>";
        } else {
            $message = "Error adding book: " . mysqli_error($conn);
            echo "<script>
            var errorMsg = document.createElement('div');
            errorMsg.classList.add('error-msg');
            errorMsg.innerText = '$message';
            document.body.appendChild(errorMsg);
            document.addEventListener('click', function() {
                errorMsg.style.display = 'none';
            });
            </script>";
        }
        
        // Reload the current page to display the message
        exit();
    }
}

// Close the connection
mysqli_close($conn);
?>
    <form method="POST" >
      <h2>Add book</h2>
        <input type="text" id="title" name="title" placeholder="Book Title" required>
        <br>
        <input type="number" id="isbn" name="isbn" placeholder="Book ISBN" required>
        <br>
        <input type="text" id="author" name="author" placeholder="Author" required>
        <br>
        <input type="number" id="copies" name="copies" placeholder="Number of copies" required>
        <br>
        <button type="submit">Submit</button>
       

    </form>
<script src="scriptadd.js"></script>
</body>
</html>