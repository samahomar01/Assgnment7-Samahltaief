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

try {
    $user_row = mysqli_fetch_assoc($user_result);
    $user_id = $user_row['user_id'];

    $category_query = "SELECT category_id, category_name, budjet FROM $expense_categories_table WHERE user_id = $user_id";
    $category_result = mysqli_query($conn, $category_query);

    if (isset($_GET['category_id'])) {
        $category_id = mysqli_real_escape_string($conn, $_GET['category_id']);

        // Fetch category name and budjet from expense_categories table
        $category_query = "SELECT category_name, budjet FROM $expense_categories_table WHERE category_id = $category_id AND user_id = $user_id";
        $category_result = mysqli_query($conn, $category_query);
        if (mysqli_num_rows($category_result) == 0) {
            throw new Exception("Category not found ");
        }

        $category_row = mysqli_fetch_assoc($category_result);
        $category_name = $category_row['category_name'];
        $budjet = $category_row['budjet'];

        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $expense_name = mysqli_real_escape_string($conn, $_POST['expense_name']);
            $expense_amount = mysqli_real_escape_string($conn, $_POST['expense_amount']);
            $note = mysqli_real_escape_string($conn, $_POST['note']);
            $date = mysqli_real_escape_string($conn, $_POST['date']);
            $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

            // Start transaction
            mysqli_begin_transaction($conn);

            // Insert expense into expenses table
            $sql = "INSERT INTO $expenses_table(expense_name, expense_amount, category_id, note, payment_method, date) VALUES ('$expense_name', '$expense_amount', '$category_id', '$note', '$payment_method', '$date')";
            if (mysqli_query($conn, $sql)) {

                // Update budjet in expense_categories table
                $update_query = "UPDATE $expense_categories_table SET budjet = budjet - $expense_amount WHERE category_id = $category_id AND user_id = $user_id";
                $update_result = mysqli_query($conn, $update_query);

                if (!$update_result) {
                    mysqli_rollback($conn);
                    throw new Exception("Failed to update budjet: " . mysqli_error($conn));
                }

                // Check if any rows were affected by the update
                if (mysqli_affected_rows($conn) == 0) {
                    mysqli_rollback($conn);
                    throw new Exception("Category not found or not owned by current user");
                }

                // Commit transaction
                mysqli_commit($conn);

                echo "Expense added successfully!";
            } else {
                mysqli_rollback($conn);
                throw new Exception("Error adding expense: " . mysqli_error($conn));
            }
        }
    } else {
        if (mysqli_num_rows($category_result) > 0) {
            $category_row = mysqli_fetch_assoc($category_result);
            $category_id = $category_row['category_id'];
            $category_name = $category_row['category_name'];
            $budjet = $category_row['budjet'];
        }
    }

    if (!$category_id) {
        throw new Exception("Category ID not found in URL");
    }

    $expense_query = "SELECT expense_name, expense_amount, note, payment_method, date FROM $expenses_table WHERE category_id = $category_id";
    $expense_result = mysqli_query($conn, $expense_query);
} catch (Exception$ex) {
    echo $ex->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="add_ex.css">
    <title>All Expenses for Category "<?php echo $category_name; ?>"</title>
</head>
<body>
    <h2>All Expenses for Category "<?php echo $category_name; ?>"</h2>
    <h1 > Dear <?php echo $username; ?>.</h1><br>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?category_id=" . $category_id; ?>">
    
        <label>Expense Name:</label>
        <input type="text" name="expense_name" required>
        <br><br>
        <label>Amount:</label>
        <input type="number" name="expense_amount" required>
        <br><br>
        <label>Date:</label>
        <input type="date" name="date" required>
        <br><br>
        <label>Payment Method:</label>
        <input type="text" name="payment_method" required>
        <br><br>
        <label>Notes:</label>
        <input type="text" name="note" required>
        <br><br>
        <input type="submit" name="submit" value="Add">
    </form>

    <table>
        <thead>
        <tr>
            <th>Expense Name</th>
            <th>Amount</th>
            <th>Notes</th>
            <th>Payment Method</th>
            <th>Date</th>
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
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <br>
</body>
</html>