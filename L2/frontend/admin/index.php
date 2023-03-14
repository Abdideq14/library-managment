<!DOCTYPE html>
<html>
<head>
	<title>Library Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type="image/png" href="../images\image.png"/>
</head>
<body>

<div class="wrapper">
  <div class="sidebar">
    
    <nav>
      <ul>
        <li><h1>Library&nbsp;Admin&nbsp;Dashboard</h1></li>
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Manage&nbsp;books</a></li>
        <li><a href="#">Add&nbsp;book</a></li>
        <li><a href="#borrowed-books">Borrowed&nbsp;books</a></li>
        <li><a href="#overdue-books">Overdue&nbsp;book&nbsp;Penalty</a></li>
        <li><a href="#">Print&nbsp;Reports</a></li>
        <li><a href="">Logout</a></li>
      </ul>
    </nav>
  </div>
</div>

<div class="main-content">
		<div class="header">
			<h2>Dashboard</h2>
		</div>
		<div class="cards">
			<div class="card">
				<h3>Books</h3>
				<p>Total: 100</p>
				<p>Borrowed: 50</p>
			</div>
			<div class="card">
				<h3>Borrowers</h3>
				<p>Total: 50</p>
				<p>Active: 25</p>
			</div>
			<div class="card">
				<h3>Reports</h3>
				<p>Most Popular Books</p>
				<p>Overdue Books</p>
			</div>
		</div>
    <form method="add-book.php" action="post">
        <h2>Manage book</h2>
        <div class="manage-btn">
          <input type="button" onclick="window.location.href='./add-form.html'" value="Add book">
        </div>
    </form>
    <table>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>ISBN</th>
        <th>Actions</th>
    </tr>
    <?php
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'mydb');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Determine whether to show only the first 5 rows or all rows
    $show_all = isset($_POST['show_all']);
    $limit = $show_all ? "" : "LIMIT 5";

    // Get books from the database
    $sql = "SELECT * FROM books $limit";
    $result = $conn->query($sql);

    // Display each book in a table row
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["author"] . "</td>";
            echo "<td>" . $row["isbn"] . "</td>";
            echo "<td class='button-cell'>";
            echo "<form method='post' action='edit.php'>";
            echo "<input type='hidden' name='isbn' value='" . $row["isbn"] . "'>";
            echo "<button type='submit'>Edit</button>";
            echo "</form>";
            echo "<form method='post' action='delete.php' onsubmit='return confirm(\"Are you sure you want to delete this book?\")'>";
            echo "<input type='hidden' name='isbn' value='" . $row["isbn"] . "'>";
            echo "<button type='submit'>Delete</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }

        // Display the "Show All" button if not already showing all rows
        if (!$show_all) {
            echo "<tr><td colspan='4'>";
            echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
            echo "<input type='hidden' name='show_all' value='1'>";
            echo "<button type='submit'>Show All</button>";
            echo "</form>";
            echo "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No books found.</td></tr>";
    }

    // Close the database connection
    $conn->close();
    ?>
</table>

    </form>
    


<div class="borrowed-books" id="borrowed-books">
  <h2>Borrowed Books</h2>
  <table>
    <thead>
      <tr>
        <th>Book Title</th>
        <th>ISBN</th>
        <th>Borrower Name</th>
        <th>Borrower Email</th>
        <th>Borrow Date</th>
        <th>Return Date</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>The Catcher in the Rye</td>
        <td>978-0316769174</td>
        <td>Jane Doe</td>
        <td>jane.doe@example.com</td>
        <td>2023-02-05</td>
        <td>2023-02-12</td>
      </tr>
      <tr>
        <td>The Great Gatsby</td>
        <td>978-0743273565</td>
        <td>John Smith</td>
        <td>john.smith@example.com</td>
        <td>2023-02-10</td>
        <td>2023-02-17</td>
      </tr>
      <tr>
        <td>To Kill a Mockingbird</td>
        <td>978-0446310789</td>
        <td>Bob Johnson</td>
        <td>bob.johnson@example.com</td>
        <td>2023-02-15</td>
        <td>2023-02-22</td>
      </tr>
    </tbody>
  </table>
</div>


<div class="admin-dashboard-module" id="overdue-books">
  <h2>Overdue Book Penalty</h2>
  <table>
    <thead>
      <tr>
        <th>User email</th>
        <th>User Name</th>
        <th>Book Title</th>
        <th>Date Borrowed</th>
        <th>Due Date</th>
        <th>Days Overdue</th>
        <th>Penalty Amount</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>johndoe@gmail.com</td>
        <td>John Doe</td>
        <td>The Great Gatsby</td>
        <td>2022-01-15</td>
        <td>2022-01-30</td>
        <td>10</td>
        <td>500 ksh</td>
      </tr>
      <tr>
        <td>janesmith@gmail.com</td>
        <td>Jane Smith</td>
        <td>To Kill a Mockingbird</td>
        <td>2022-01-20</td>
        <td>2022-02-05</td>
        <td>8</td>
        <td>400 ksh</td>
      </tr>
      <tr>
        <td>markjohnson@gmail.com</td>
        <td>Mark Johnson</td>
        <td>1984</td>
        <td>2022-01-25</td>
        <td>2022-02-09</td>
        <td>6</td>
        <td>300 ksh</td>
      </tr>
    </tbody>
  </table>
</div>


</div>

</div>
</div>
<script src="script.js"></script>
</body>
</html>
