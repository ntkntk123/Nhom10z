<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="login-form">
        <h2>Đăng Nhập</h2>
        <form action="?act=login" method="POST">
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit" name="dangnhap">Đăng Nhập</button>
        </form>
        <p>Chưa có tài khoản? <a href="/register">Đăng ký ngay</a></p>
    </div>
</body>

</html>