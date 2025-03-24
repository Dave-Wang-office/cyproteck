<?php
// 连接数据库
$conn = new mysqli("localhost", "root", "", "testdb");
if($conn->connect_error){
    die("error: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM images ORDER BY upload_time DESC");

echo "<h2>picture</h2>";

while($row = $result->fetch_assoc()){
    echo "<div style='display:inline-block; margin:10px; text-align:center;'>";
    echo "<img src='uploads/" . $row['filename'] . "' alt='图片' style='width:200px; height:auto;'/><br>";
    echo "<small>上传时间：" . $row['upload_time'] . "</small><br>";
    echo "<a href='image_download.php?filename=" . urlencode($row['filename']) . "'>download</a>";
    echo "</div>";
}

$conn->close();
?>
