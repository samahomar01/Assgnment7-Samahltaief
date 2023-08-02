<?php
require_once 'database.php';
$users_table = "users_table";
$expense_categories_table = "expense_categories";
$expenses_table = "ex_table";


session_start();

if (!isset($_SESSION['username'])) {
  die("User ID not found in session");
}

$username = $_SESSION['username'];

$user_query = "SELECT user_id FROM $users_table WHERE user_name = '$username'";
$user_result = mysqli_query($conn, $user_query);

if (!$user_result) {
  die("Query failed: " . mysqli_error($conn));
}

$user_row = mysqli_fetch_assoc($user_result);
$user_id = $user_row['user_id'];


if (!isset($_GET['category_id'])) {
  die("Category ID not found in URL");
}

$category_id = mysqli_real_escape_string($conn, $_GET['category_id']);

// Fetch category name and original balance from expense_categories table
$category_query = "SELECT category_name, budjet FROM $expense_categories_table WHERE category_id = $category_id AND user_id = $user_id";
$category_result = mysqli_query($conn, $category_query);

if (!$category_result) {
  die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($category_result) == 0) {
  die("Category not found ");
}

$category_row = mysqli_fetch_assoc($category_result);
$category_name = $category_row['category_name'];
$original_balance = $category_row['budjet'];

// Display original balance and category name
echo "Budget for category " . $category_name . ": " . $original_balance;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Budget for Category "<?php echo $category_name; ?>"</title>
 
</head>
<body>
  

</body>
</html>