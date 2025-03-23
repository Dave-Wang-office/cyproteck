<?php
// 启动会话，用于记录登陆状态（可选）
session_start();

// 数据库连接参数
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";  // XAMPP 默认密码为空
$dbname = "testdb";

// 创建数据库连接
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取表单提交的用户名和密码
$username = $_POST['username'];
$password = $_POST['password'];

// 使用预处理语句，查询指定用户名的记录
$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    // 找到该用户，获取记录
    $row = $result->fetch_assoc();
    // 验证密码是否匹配，使用 password_verify 函数
    if(password_verify($password, $row['password'])){
        // 密码正确，登陆成功
        $_SESSION['username'] = $row['username'];  // 保存用户信息到会话中
        echo "登陆成功！欢迎，" . $row['username'];
    } else {
        // 密码错误
        echo "密码错误，请重试。";
    }
} else {
    // 未查询到该用户
    echo "用户不存在，请先注册。";
}

$stmt->close();
$conn->close();
?>
