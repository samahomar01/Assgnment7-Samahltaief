<?php
require_once 'database.php';
session_start();

if (!isset($_GET['date'])) {
   
    header("Location: previous_page.php");
    exit;
}

$date = $_GET['date'];
$username = $_SESSION['username'];
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';
$sql = "SELECT * FROM ex_table WHERE date = '$date' AND category_id = '$category_id'";
$result = mysqli_query($conn, $sql);


if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Search Results:</h2>";
        echo "<table>";
        echo "<tr><th>Expense ID</th> <th>Amount</th> <th>note</th> <th>Date</th> </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['expense_name'] . "</td>";
            echo "<td>" . $row['expense_amount'] . "</td>";
            echo "<td>" . $row['note'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
          
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No expenses found.";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search Expenses</title>
    <link rel="stylesheet" href="search.css">
</head>
<body>
  
</body>
</html>