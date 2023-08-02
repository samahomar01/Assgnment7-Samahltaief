<?php
require_once 'database.php';
$users_table = "users_table";
$expense_categories_table = "expense_categories";
$expenses_table = "ex_table";
$transfers_table = "transfers";
session_start();

if (!isset($_SESSION['username'])) {
    die("User ID not found in session");
}

$username = $_SESSION['username'];


$user_query = "SELECT user_id FROM $users_table WHERE user_name = '$username'";
$user_result = mysqli_query($conn, $user_query);
$user_row = mysqli_fetch_assoc($user_result);
$user_id = $user_row['user_id'];

// Retrieve the expense categories for the logged-in user
$categories_query = "SELECT * FROM $expense_categories_table WHERE user_id = $user_id";
$result_categories = mysqli_query($conn, $categories_query);

// Check if the form has been submitted
if (isset($_POST['category_from']) && isset($_POST['category_to']) && isset($_POST['amount']) && isset($_POST['date'])) {
    $category_from_id = mysqli_real_escape_string($conn, $_POST['category_from']);
    $category_to_id = mysqli_real_escape_string($conn, $_POST['category_to']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    try {
        mysqli_begin_transaction($conn);

        // Check if the amount to transfer is available in the budget of the source category
        $check_query = "SELECT budjet FROM $expense_categories_table WHERE category_id = $category_from_id";
        $check_result = mysqli_query($conn, $check_query);
        $check_row = mysqli_fetch_assoc($check_result);
        $source_category_budget = $check_row['budjet'];

        if ($amount > $source_category_budget) {
            throw new Exception("The amount to transfer is not available in the budget of the source category.");
        }

        // Insert  into the transfers table
        $transfer_query = "INSERT INTO $transfers_table (transfer_amount, from_cat, to_cat, comment, date_transfer) VALUES ($amount, $category_from_id, $category_to_id, '$comment', '$date')";
        mysqli_query($conn, $transfer_query);

        $update_query = "UPDATE $expense_categories_table SET budjet = CASE category_id WHEN
            $category_to_id THEN budjet + $amount WHEN $category_from_id THEN
            budjet- $amount END WHERE category_id IN ($category_to_id, $category_from_id)";
        mysqli_query($conn, $update_query);

        mysqli_commit($conn);
        echo "The transfer was successful!";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transfer Category Budget</title>
   <h1> <?php echo $username ?></h1>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-top: 50px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        label, select, input[type='submit'], textarea {
            display: block;
            width: 100%;
            margin-bottom: 20px;
            font-size: 18px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        select, input[type='submit'], textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type='number'],
        input[type='date'] {
            width: 100%;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        input[type='submit'] {
            background-color: #6f337a;
            border: none;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            border-radius: 5px;
        }

        input[type='submit']:hover {
            background-color: #6f337a;
        }
    </style>
</head>
<body>
    <h2>Transfer Category Budget</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="category_from">Source Category:</label>
        <select id="category_from" name="category_from">
            <?php while ($row = mysqli_fetch_assoc($result_categories)) { ?>
                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
            <?php } ?>
        </select>
        <label for="category_to">Destination Category:</label>
        <select id="category_to" name="category_to">
            <?php mysqli_data_seek($result_categories, 0);  ?>
            <?php while ($row = mysqli_fetch_assoc($result_categories)) { ?>
                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
            <?php } ?>
        </select>
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date">
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment"></textarea>
        <input type="submit" value="Transfer">
    </form>

    

    <?php mysqli_close($conn); ?>
</body>
</html>