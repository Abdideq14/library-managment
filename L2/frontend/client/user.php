<?php
			// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['keywords']) || isset($_GET['author']) || isset($_GET['title']) || isset($_GET['isbn'])) {
    $keywords = $_GET['keywords'];
    $author = $_GET['author'];
    $title = $_GET['title'];
    $isbn = $_GET['isbn'];

    // Build the SQL query based on the search criteria
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
        $sql .= " AND isbn = '$isbn'";
    }

    // Execute the SQL query and display the results in a styled table
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Title</th><th>Author</th><th>ISBN</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['author'] . "</td>";
            echo "<td>" . $row['isbn'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
}
?>
