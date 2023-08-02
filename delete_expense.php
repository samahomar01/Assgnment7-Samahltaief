<?php

require_once 'database.php';

$expenses_table = "ex_table";

// Check if delete button is clicked
if (isset($_POST['delete_expense'])) {
    // Get expense ID and category ID from hidden input fields
    $expense_id = mysqli_real_escape_string($conn, $_GET['ex_id']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    try {
        // Delete expense from expenses table
        $sql = "DELETE FROM $expenses_table WHERE ex_id = $expense_id AND category_id = $category_id";
        if (mysqli_query($conn, $sql)) {
            echo "Expense deleted successfully!";
        } else {
            throw new Exception(mysqli_error($conn));
        }
    } catch (Exception $e) {
        echo "Error deleting expense: " . $e->getMessage();
    }
}
?>