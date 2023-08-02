<!-- Display list of expenses --> <table> <thead> <tr> <th>Expense Name</th>
 <th>Amount</th> <th>Date</th> <th>Notes</th>
  <th>Payment Method</th> <th>Edit</th> </tr> </thead>
  <link rel="stylesheet" type="text/css" href="update.css">
   <tbody>
     <?php require_once 'database.php';

        $expenses_table = "ex_table";

        // Fetch expenses for current category ID
        if (!isset($_GET['category_id'])) {
            die("Category ID not found in URL");
        }
        $category_id = mysqli_real_escape_string($conn, $_GET['category_id']);
        $expenses_query = "SELECT ex_id, expense_name, expense_amount, note, payment_method, date FROM $expenses_table WHERE category_id = $category_id";
        $expenses_result = mysqli_query($conn, $expenses_query);

        // Loop through expenses and display them in table rows
        while ($expense_row = mysqli_fetch_assoc($expenses_result)) {
            echo "<tr>";
            echo "<td>" . $expense_row['expense_name'] . "</td>";
            echo "<td>" . $expense_row['expense_amount'] . "</td>";
            echo "<td>" . $expense_row['date'] . "</td>";
            echo "<td>" . $expense_row['note'] . "</td>";
            echo "<td>" . $expense_row['payment_method'] . "</td>";
            echo "<td><a href='edit.php?ex_id=" . $expense_row['ex_id'] . "&category_id=" . $category_id . "'>Edit</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>