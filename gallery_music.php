<?php
// 连接数据库
$conn = new mysqli("localhost", "root", "", "testdb");
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 查询所有音乐记录，按上传时间倒序排列
$result = $conn->query("SELECT * FROM music ORDER BY upload_time DESC");

echo "<h2>音乐库</h2>";

while ($row = $result->fetch_assoc()) {
    echo "<div style='margin-bottom:20px;'>";
    // 使用 <audio> 标签播放音乐（假设上传的是 MP3 文件，可根据实际情况调整 MIME 类型）
    echo "<audio controls>";
    echo "<source src='uploads/music/" . $row['filename'] . "' type='audio/mpeg'>";
    echo "您的浏览器不支持音频播放。";
    echo "</audio><br>";
    echo "<small>上传时间：" . $row['upload_time'] . "</small>";
    echo "</div>";
}

$conn->close();
?>
