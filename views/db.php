<?php
// db.php

// Bao gồm file cấu hình môi trường
require_once './commonsz/env.php';

try {
    // Tạo kết nối PDO với cơ sở dữ liệu MySQL
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT;
    $conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    
    // Thiết lập chế độ báo lỗi cho PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Nếu kết nối thành công, bạn có thể thử echo hoặc log ra thông báo để kiểm tra
    // echo "Kết nối cơ sở dữ liệu thành công!";
} catch (PDOException $e) {
    // Nếu kết nối không thành công, hiển thị thông báo lỗi
    echo "Kết nối thất bại: " . $e->getMessage();
    exit();
}
?>
