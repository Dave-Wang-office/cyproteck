<?php
// 数据库连接参数
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";  // XAMPP 默认密码为空
$dbname = "testdb";

// 创建连接
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取用户提交的数据
$username = $_POST['username'];
$password = $_POST['password'];

// 密码加密处理（建议使用 PHP 内置的 password_hash 函数）
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// 为了防止 SQL 注入，建议使用预处理语句
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashedPassword);

if ($stmt->execute()) {
    echo "注册成功！";
} else {
    echo "注册失败: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
