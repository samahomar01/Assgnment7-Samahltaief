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
$user_row = mysqli_fetch_assoc($user_result);
$user_id = $user_row['user_id'];

// Fetch all expense categories 
$category_query = "SELECT category_id, category_name FROM $expense_categories_table WHERE user_id = $user_id";
$category_result = mysqli_query($conn, $category_query);


if (!isset($_GET['category_id'])) {
  die("Category ID not found in URL");
}

$category_id = mysqli_real_escape_string($conn, $_GET['category_id']);


$category_query = "SELECT category_name FROM $expense_categories_table WHERE category_id = $category_id AND user_id = $user_id";
$category_result = mysqli_query($conn, $category_query);
if (mysqli_num_rows($category_result) == 0) {
  die("Category not found or not owned by current user");
}

$category_row = mysqli_fetch_assoc($category_result);
$category_name = $category_row['category_name'];




$expense_query = "SELECT ex_id, expense_name, expense_amount, note, payment_method, date FROM $expenses_table WHERE category_id = $category_id";
$expense_result = mysqli_query($conn, $expense_query);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="add_ex.css">
  <title>All Expenses for Category "<?php echo $category_name; ?>"</title>
</head>
<body>
<h2>All Expenses for Category "<?php echo $category_name; ?>"</h2>
  
  <table>
    <thead>
      <tr>
        <th>Expense Name</th>
        <th>Amount</th>
        <th>Notes</th>
        <th>Payment Method</th>
        <th>Date</th>
        <th>Options</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($expense_row = mysqli_fetch_assoc($expense_result)) { ?>
        <tr>
          <td><?php echo $expense_row['expense_name']; ?></td>
          <td><?php echo $expense_row['expense_amount']; ?></td>
          <td><?php echo $expense_row['note']; ?></td>
          <td><?php echo $expense_row['payment_method']; ?></td>
          <td><?php echo $expense_row['date']; ?></td>
          <td>
            <form method="POST" action="delete_expense.php?ex_id=<?php echo $expense_row['ex_id']; ?>&category_id=<?php echo $category_id; ?>">
              <input type="hidden" name="expense_id" value="<?php echo $expense_row['ex_id']; ?>">
              <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
              <button type="submit" name="delete_expense">Delete</button>
            </form>

            <form method="POST" action="up.php?ex_id=<?php echo $expense_row['ex_id']; ?>&category_id=<?php echo $category_id; ?>">
              <input type="hidden" name="expense_id" value="<?php echo $expense_row['ex_id']; ?>">
              <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
              <button type="submit" name="edit">Edit</button>
            </form>
          </td>
        </tr      <?php } ?>
     </tbody>
  </table>
  <br>
</body>
</html>