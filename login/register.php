
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="../css/logup.css">
    <link rel="stylesheet" href="./css/logup.css">
</head>
<body>
    <div class="form-container">
        <h2>Đăng Ký</h2>
        <form action="./?act=register" method="POST">
            <label for="username">Tài khoản</label>
            <input type="text" id="username" name="username" placeholder="Nhập tên tài khoản" required>

            <label for="ten_khach_hang">Tên khách hàng</label>
            <input type="text" id="ten_khach_hang" name="ten_khach_hang" placeholder="Nhập tên khách hàng" required>
            

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Nhập email" required>

            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>

            <label for="password2">Xác nhận mật khẩu</label>
            <input type="password" id="password2" name="password2" required>

            <button type="submit">Đăng Ký</button>
        </form>
    </div>
</body>
</html>
