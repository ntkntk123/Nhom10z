<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <style>
        
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }

        .login-form {
            width: 500px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #fff;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 93%;
            padding: 20px;
            margin: 30px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .login-form button {
            width: 50%;
            margin-left: 125px;
            padding: 15px;
            background-color: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #0056b3;
            background-color: red;
        }

        .login-form p {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .login-form a {
            color: #007bff;
            text-decoration: none;
        }

    </style>
</head>

<body>
    <!-- <?php
    if(isset($_SESSION["username"])){
        echo "ban da dang nhap voi tai khoan". $_SESSION["username"];
        
    }
    ?> -->
<div class="login-form">
    <h2>Đăng Nhập</h2>
    <form id="loginForm" action="?act=login" method="POST" onsubmit="return validateForm()">
        <input type="text" name="username" id="username" placeholder="Tên đăng nhập" >
        <span id="errUser" style="color:red"></span>
        <input id="password" type="password" name="password" placeholder="Mật khẩu" >
        <?php if (!empty($err)): ?>
            <p style="color: red;"><?php echo ($err); ?></p>
        <?php endif; ?>
        
        <button type="submit" name="dangnhap">Đăng Nhập</button>
    </form>
    <p>Chưa có tài khoản? <a href="?act=formRegister">Đăng ký ngay</a></p>
</div>
</body>

<script>
    function validateForm() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if (username === "") {
            document.getElementById('errUser').innerHTML="Tên đăng nhập không được để trống!";
            return false;
        }

        if (password === "") {
            alert("Mật khẩu không được để trống!");
            return false;
        }
        return true;
    }
</script>

</html>