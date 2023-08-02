<?php
require_once 'database.php';

$expenses_table = "ex_table";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get expense ID and category ID from hidden input fields
    $expense_id = mysqli_real_escape_string($conn, $_POST['ex_id']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);


    $expense_name = mysqli_real_escape_string($conn, $_POST['expense_name']);
    $expense_amount = mysqli_real_escape_string($conn, $_POST['expense_amount']);
    $note = mysqli_real_escape_string($conn, $_POST['note']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

    $sql = "UPDATE $expenses_table SET expense_name = '$expense_name', expense_amount = '$expense_amount', note = '$note', payment_method = '$payment_method', date = '$date' WHERE ex_id = $expense_id AND category_id = $category_id";
    if (mysqli_query($conn, $sql)) {
        echo "Expense updated successfully!";
    } else {
        die("Error updating expense: " . mysqli_error($conn));
    }
}

// Fetch expense details for current expense ID
if (!isset($_GET['ex_id'])) {
    die("Expense ID not found in URL");
}
$expense_id = mysqli_real_escape_string($conn, $_GET['ex_id']);
$expense_query = "SELECT expense_name, expense_amount, note, payment_method, date FROM $expenses_table WHERE ex_id = $expense_id";
$expense_result = mysqli_query($conn, $expense_query);

// Check if expense is found in expenses table
if (mysqli_num_rows($expense_result) == 0) {
    die("Expense not found");
}

$expense_row = mysqli_fetch_assoc($expense_result);
$category_id = mysqli_real_escape_string($conn, $_GET['category_id']);
?>
<link rel="stylesheet" type="text/css" href="update.css">

<form method="post">
    
    <input type="hidden" name="ex_id" value="<?php echo $expense_id; ?>">
    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
    <label for="expense_name">Expense Name:</label>
    <input type="text" name="expense_name" value="<?php echo $expense_row['expense_name']; ?>"><br><br>
    <label for="expense_amount">Amount:</label>
    <input type="text" name="expense_amount" value="<?php echo $expense_row['expense_amount']; ?>"><br><br>
    <label for="note">Notes:</label>
    <input type="text" name="note" value="<?php echo $expense_row['note']; ?>"><br><br>
    <label for="date">Expense Date:</label>
    <input type="date" name="date" value="<?php echo $expense_row['date']; ?>"><br><br>
    <label for="payment_method">Payment Method:</label>
    <select name="payment_method">
        <option value="Cash" <?php if ($expense_row['payment_method'] == 'Cash') echo 'selected'; ?>>Cash</option>
        <option value="Credit Card" <?php if ($expense_row['payment_method'] == 'Credit Card') echo 'selected'; ?>>Credit Card</option>
      

    </select><br><br>
    <input type="submit" value="Update Expense">
</form>