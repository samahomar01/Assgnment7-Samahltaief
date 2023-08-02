<?php
require_once 'database.php';
$users_table = "users_table";
session_start();


if (!isset($_SESSION['username'])) {
    die("User ID not found in session");
}

$username = $_SESSION['username'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $rating = $_POST['star'];
    $comment = $_POST['comment'];
    $sql = "INSERT INTO rating (rating, comment, user_id)
     VALUES ('$rating', '$comment', (SELECT user_id FROM $users_table WHERE user_name='$username'))";
    if ($conn->query($sql) === TRUE) {
        echo "Rating added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
}

// Retrieve all ratings and calculate the average rating
$sql = "SELECT rating, comment FROM rating ORDER BY rating DESC";
$result = $conn->query($sql);
$total_ratings = $result->num_rows;
$sum_ratings = 0;
while ($row = $result->fetch_assoc()) {
    $sum_ratings += $row['rating'];
}
$average_rating = ($total_ratings > 0) ? round($sum_ratings / $total_ratings, 1) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracking App Review</title>
    <h1> <?php echo $username ?></h1>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Expense Tracking App Review</h1>
    <p>Please rate our app and provide your feedback:</p>

    <form id="Rating.php" method="POST" action="Rating.php">
        <div class="rating">
            <input type="radio" name="star" id="star-1" value="1">
            <label for="star-1"></label>
            <input type="radio" name="star" id="star-2" value="2">
            <label for="star-2"></label>
            <input type="radio" name="star" id="star-3" value="3">
            <label for="star-3"></label>
            <input type="radio" name="star" id="star-4" value="4">
            <label for="star-4"></label>
            <input type="radio" name="star" id="star-5" value="5">
            <label for="star-5"></label>
        </div>
        <br>
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" rows="5" required></textarea>
        <br>
        <button type="submit">Submit Review</button>
    </form>

    <h2>Reviews</h2>
    <p>Average Rating: <?php echo $average_rating; ?> stars</p>
    <?php
    $result = $conn->query($sql); 
    while ($row = $result->fetch_assoc()) {
        $rating = $row['rating'];
        $comment = $row['comment'];
        $stars = '';
        for ($i = 1; $i <= $rating; $i++) {
            $stars .= '&#9733;';
        }
        for ($i = $rating + 1; $i <= 5; $i++) {
            $stars .= '&#9734;';
        }
        echo "<div class='review'>";
        echo "<span class='stars'>$stars</span>";
        echo "<p class='comment'>$comment</p>";
        echo "</div>";
    }
    ?>

</body>
</html>