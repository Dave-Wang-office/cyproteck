<?php
// 连接数据库
$conn = new mysqli("localhost", "root", "", "testdb");
if($conn->connect_error){
    die("error: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM videos ORDER BY upload_time DESC");

echo "<h2>video</h2>";

while($row = $result->fetch_assoc()){
    echo "<div style='margin-bottom:20px;'>";
    echo "<video width='320' controls>";
    echo "<source src='uploads/videos/" . $row['filename'] . "' type='video/mp4'>";
    echo "browser problem";
    echo "</video><br>";
    echo "<small>上传时间：" . $row['upload_time'] . "</small><br>";
    echo "<a href='video_download.php?filename=" . urlencode($row['filename']) . "'>download</a>";
    echo "</div>";
}

$conn->close();
?>
