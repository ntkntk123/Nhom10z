<?php
// Kiểm tra nếu session chưa được khởi tạo thì gọi session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Xử lý form đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra dữ liệu đăng nhập (thay thế bằng logic thực tế)
    if (empty($username)) {
        $err = "Tên đăng nhập không được để trống!";
    } elseif (empty($password)) {
        $err = "Mật khẩu không được để trống!";
    } else {
        // Giả sử đăng nhập thành công (kiểm tra với cơ sở dữ liệu)
        $_SESSION["username"] = $username;
        header("Location: ./index.php"); // Chuyển hướng sau khi đăng nhập thành công
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        footer {
    background-color: #f8f9fa;
    padding: 20px 0;
    margin-top: 50px;
}

footer .container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 30px;
}

footer .footer-section {
    flex: 1;
    min-width: 200px;
    max-width: 300px;
}

footer h3 {
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
    font-weight: bold;
}

footer p {
    font-size: 14px;
    color: #555;
}

footer .feedback-button {
    background-color: #ff4d4d;
    color: white;
    border: none;
    padding: 12px;
    width: 100%;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px;
}

footer .feedback-button:hover {
    background-color: #ff3333;
}

@media (max-width: 768px) {
    footer .container {
        flex-direction: column;
        align-items: center;
    }
    footer .footer-section {
        text-align: center;
    }
}

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .logo {
            width: 40px;
            height: 40px;
            background-color: #e0e0e0;
            margin-right: 10px;
        }

        /* Header */
        header {
            background-color: #fff;
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Form Styles */
        .login-form {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
            transition: border 0.3s ease;
        }

        .login-form input[type="text"]:focus,
        .login-form input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .login-form button {
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }

        .login-form p {
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        .login-form a {
            color: #007bff;
            text-decoration: none;
        }

        .login-form a:hover {
            text-decoration: underline;
        }

        /* Error message style */
        #errUser {
            font-size: 12px;
            color: red;
            margin-top: -8px;
            margin-bottom: 15px;
        }

        /* Footer styles */
        footer {
            background-color: #f1f1f1;
            padding: 20px 0;
        }

        footer .container {
            display: flex;
            justify-content: space-between;
        }

        footer h3 {
            font-size: 18px;
            color: #333;
        }

        footer p {
            font-size: 14px;
            color: #777;
        }

        footer .feedback-button {
            margin-top: 20px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        footer .feedback-button:hover {
            background-color: #ff3333;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .login-form {
                width: 90%;
                padding: 20px;
            }

            .login-form h2 {
                font-size: 22px;
            }

            .login-form button {
                padding: 12px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <header>
        <div class="container">
            <div class="logo"></div>
            <nav class="d-flex gap-4">
                <a href="#" class="text-decoration-none text-dark fw-bold">Sale 50%</a>
                <a href="#" class="text-decoration-none text-dark fw-bold">Sản Phẩm</a>
                <a href="#" class="text-decoration-none text-dark fw-bold">Đồ Lót</a>
                <a href="#" class="text-decoration-none text-dark fw-bold">Đồ Mặc Hàng Ngày</a>
            </nav>
            <div class="d-flex gap-3">
                <input type="text" placeholder="Tìm kiếm sản phẩm..." class="form-control" style="width: 250px;">
                <div class="d-flex gap-4 align-items-center">
                    <!-- Đăng nhập -->
                    <a href="?act=login" class="text-decoration-none text-dark text-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeUUz1pW3PpdJVcOvcwfYWdKFK4wBGL_UvcA&s" alt="User Icon" class="user-icon bg-secondary rounded-circle" style="width: 40px; height: 40px;">
                        <br>
                        <small>Đăng nhập</small>
                    </a>

                    <!-- Đăng ký -->
                    <a href="?act=formRegister" class="text-decoration-none text-dark text-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeUUz1pW3PpdJVcOvcwfYWdKFK4wBGL_UvcA&s" alt="User Icon" class="user-icon bg-secondary rounded-circle" style="width: 40px; height: 40px;">
                        <br>
                        <small>Đăng ký</small>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Login Form Section -->
    <div class="login-form">
        <h2>Đăng Nhập</h2>
        <form id="loginForm" action="" method="POST" onsubmit="return validateForm()">
            <input type="text" name="username" id="username" placeholder="Tên đăng nhập" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
            <span id="errUser" style="color:red"><?php echo isset($err) && !empty($err) && strpos($err, 'Tên đăng nhập') !== false ? $err : ''; ?></span>
            <input id="password" type="password" name="password" placeholder="Mật khẩu">
            <span id="errPassword" style="color:red"><?php echo isset($err) && !empty($err) && strpos($err, 'Mật khẩu') !== false ? $err : ''; ?></span>
            
            <?php if (isset($err) && empty($username) && strpos($err, 'Tên đăng nhập') === false): ?>
                <p style="color: red;"><?php echo ($err); ?></p>
            <?php endif; ?>
            
            <button type="submit" name="dangnhap">Đăng Nhập</button>
        </form>
        <p>Chưa có tài khoản? <a href="?act=formRegister">Đăng ký ngay</a></p>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <div class="footer-section">
                <h3>Hotline</h3>
                <p>0888292005</p>
                <p>Email: nhom10@gmail.com</p>
            </div>
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Our story and team</p>
                <p>Our factory</p>
                <p>Code of conduct</p>
            </div>
            <div class="footer-section">
                <h3>Contact Address</h3>
                <p>Tòa P, Tầng 4, Phòng P404</p>
                <p>FPT Polytechnic, Trịnh Văn Bô, Hà Nội</p>
            </div>
        </div>
        <button class="feedback-button btn btn-danger w-100">Give Feedback</button>
    </footer>

    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            var usernameError = document.getElementById('errUser');
            var passwordError = document.getElementById('errPassword');
            var formIsValid = true;

            // Clear previous error messages
            usernameError.innerHTML = "";
            passwordError.innerHTML = "";

            // Validate username
            if (username === "") {
                usernameError.innerHTML = "Tên đăng nhập không được để trống!";
                formIsValid = false;
            }

            // Validate password
            if (password === "") {
                passwordError.innerHTML = "Mật khẩu không được để trống!";
                formIsValid = false;
            }

            return formIsValid;
        }
    </script>
</body>

</html>
