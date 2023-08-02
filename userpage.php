<?php
require_once 'database.php';

session_start();
$user_name = $_SESSION['username'];


if(!isset($_SESSION['username'])){
    header("Location: login.php");
}



if (isset($_POST['logout']) && hash_equals($_SESSION['token'], $_POST['token'])) {
    
    session_destroy();
    // تحديد التوجيه والانتظار قبل التوجيه
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Location: login.php");
    exit;
}

// إنشاء رمز عشوائي للاستخدام في التحقق من صحة الطلب
$token = bin2hex(random_bytes(32));
$_SESSION['token'] = $token;
?>


<!DOCTYPE html>

<html lang="en">


<head>  
    <meta charset="UTF-8">
    <link rel="stylesheet" href="user.css">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Welcome <?php echo $user_name; ?></title>
 
</head>
<body>
<div class="navbar">
    <div class="container">
  
        <h1>Welcome <?php echo $user_name; ?>!</h1>
        <p>This is your personal page.</p>
        <p>You can customize it to display any information you want.</p>
        <p>Enjoy!</p>

    
        <form action="add_cat.php">
    <input type="submit" value="Add Category">
</form>

<form action="update_cost.php">
    <input type="submit" value="Update Category">
</form>

<form action="	update_user.php">
    <input type="submit" value="Update User name">
</form>


<form action="	view_cat.php">
    <input type="submit" value="Expenses">
</form>

<form action="transfer.php">
    <input type="submit" value="Transfer">
</form>
<form action="Rating.php">
    <input type="submit" value="Rating">
</form>



<form method="post" action="">
            <input type="hidden" name="token" value="<?php echo $token ?>">
            <input type="submit" name="logout" value="logout">
        </form>

     
    </div>
    </div>
</body>
</html>
