<?php
// 设置上传目录
$targetDir = "uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// 允许的图片文件类型
$allowedTypes = array("jpg", "jpeg", "png", "gif");

if(isset($_POST['submit'])) {
    $file = $_FILES['image'];
    $fileName = basename($file["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
    // 检查文件类型
    if(in_array($fileType, $allowedTypes)){
        // 尝试上传文件
        if(move_uploaded_file($file["tmp_name"], $targetFilePath)){
            // 连接数据库（请确保数据库连接参数正确）
            $conn = new mysqli("localhost", "root", "", "testdb");
            if($conn->connect_error){
                die("连接失败: " . $conn->connect_error);
            }
            // 使用预处理语句将文件信息存入数据库
            $stmt = $conn->prepare("INSERT INTO images (filename) VALUES (?)");
            $stmt->bind_param("s", $fileName);
            if($stmt->execute()){
                echo "图片上传成功！<br>";
                echo "<a href='gallery.php'>查看图片库</a>";
            } else {
                echo "图片信息保存失败: " . $stmt->error;
            }
            $stmt->close();
            $conn->close();
        } else {
            echo "图片上传出错，请重试。";
        }
    } else {
        echo "仅允许上传 JPG, JPEG, PNG, GIF 格式的图片。";
    }
}
?>
