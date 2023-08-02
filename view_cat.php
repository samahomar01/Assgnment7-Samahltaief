<?php
// Include database connection file
require_once 'database.php';

$users_table = "users_table";
$expense_categories_table = "expense_categories";

// Start session
session_start();

if (!isset($_SESSION['username'])) {
    die("User ID not found in session");
}

$username = $_SESSION['username'];

// Fetch user ID from users_table
$user_query = "SELECT user_id FROM $users_table WHERE user_name = '$username'";
$user_result = mysqli_query($conn, $user_query);
$user_row = mysqli_fetch_assoc($user_result);
$user_id = $user_row['user_id'];

// Fetch all categories for current user
$category_query = "SELECT category_id, category_name FROM $expense_categories_table WHERE user_id = $user_id";
$category_result = mysqli_query($conn, $category_query);

// Check for SQL query result and set $categories_result variable
if ($category_result) {
  $categories_result = $category_result;
} else {
  die("Error fetching categories: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>View Categories</title>
  <style>
    /* Style for the table */
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #6f337a;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    /* Style for the buttons */
    .category-button {
      padding: 10px 20px;
      background-color: #6f337a;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-right: 10px;
    }

    .category-button:hover {
      background-color: #4b1e52;
    }

    .add-expense-link {
      padding: 10px 20px;
      background-color: #6f337a;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-right: 10px;
      text-decoration: none;
    }

    .add-expense-link:hover {
      background-color: #4b1e52;
    }
  </style>
</head>
<body>
  <h2>View Categories</h2>

  <table>
    <thead>
      <tr>
        <th>Category Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($category_row = mysqli_fetch_assoc($categories_result)) { ?>
        <tr>
          <td><?php echo $category_row['category_name']; ?></td>
          <td>
            <form method="get" action="view_expenses.php">
              <button class="category-button" type="submit" name="category_id" value="<?php echo $category_row['category_id']; ?>">View Expenses</button>
            </form> <br>

            <a href="add_ex.php?category_id=<?php echo $category_row['category_id']; ?>" class="add-expense-link">Add Expense</a> <br><br><br>
            <a href="all_bud.php?category_id=<?php echo $category_row['category_id']; ?>" class="add-expense-link"> budget</a> 
             <br><br>
            <form action="serch.php" method="get">
           <label for="date">Search Date:</label>
           <input type="date" id="date" name="date">
           <input type="hidden" name="category_id" value="<?php echo $category_row['category_id']; ?>">
           <input type="submit" value="Search">
         
</form>
        </tr>
          </td>

          
      <?php } ?>
    </tbody>
  </table>
 
</body>
</html>