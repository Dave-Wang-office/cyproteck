<?php
// 连接数据库
$conn = new mysqli("localhost", "root", "", "testdb");
if($conn->connect_error){
    die("连接失败: " . $conn->connect_error);
}

// 查询所有图片信息，按上传时间倒序排列
$result = $conn->query("SELECT * FROM images ORDER BY upload_time DESC");

echo "<h2>图片库</h2>";

while($row = $result->fetch_assoc()){
    echo "<div style='display:inline-block; margin:10px; text-align:center;'>";
    echo "<img src='uploads/" . $row['filename'] . "' alt='图片' style='width:200px; height:auto;'/><br>";
    echo "<small>上传时间：" . $row['upload_time'] . "</small>";
    echo "</div>";
}

$conn->close();
?>
