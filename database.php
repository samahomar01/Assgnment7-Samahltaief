<?php

$host = "localhost"; // اسم الخادم المضيف لقاعدة البيانات
$user = "root"; // اسم المستخدم الخاص بقاعدة البيانات
$password = ""; // كلمة مرور المستخدم الخاص بقاعدة البيانات
$database = "expense trackeer"; // اسم قاعدة البيانات
// الاتصال بقاعدة البيانات
$conn = mysqli_connect($host, $user, $password, $database);

// تحقق من اتصال قاعدة البيانات
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>