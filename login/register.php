<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
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
        .register-form {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .register-form h2 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .register-form label {
            font-size: 14px;
            color: #555;
            margin-bottom: 6px;
            display: block;
        }

        .register-form input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
            transition: border 0.3s ease;
        }

        .register-form input:focus {
            border-color: #007bff;
            outline: none;
        }

        .register-form button {
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

        .register-form button:hover {
            background-color: #0056b3;
        }

        .register-form p {
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        .register-form a {
            color: #007bff;
            text-decoration: none;
        }

        .register-form a:hover {
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
            .register-form {
                width: 90%;
                padding: 20px;
            }

            .register-form h2 {
                font-size: 22px;
            }

            .register-form button {
                padding: 12px;
                font-size: 14px;
            }
        }

    </style>
</head>
<body>

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
                    <a href="?act=login" class="text-decoration-none text-dark text-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeUUz1pW3PpdJVcOvcwfYWdKFK4wBGL_UvcA&s" alt="User Icon" class="user-icon bg-secondary rounded-circle" style="width: 40px; height: 40px;">
                        <br>
                        <small>Đăng nhập</small>
                    </a>
                    <a href="?act=formRegister" class="text-decoration-none text-dark text-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeUUz1pW3PpdJVcOvcwfYWdKFK4wBGL_UvcA&s" alt="User Icon" class="user-icon bg-secondary rounded-circle" style="width: 40px; height: 40px;">
                        <br>
                        <small>Đăng ký</small>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="register-form">
        <h2>Đăng Ký</h2>
        <form action="./?act=register" method="POST">
            <input type="text" name="username" id="username" placeholder="Tên tài khoản" required>

            <input type="text" name="ten_khach_hang" id="ten_khach_hang" placeholder="Tên khách hàng" required>

            <input type="email" name="email" id="email" placeholder="Email" required>
            
            <input type="number" name="phone" id="phone" placeholder="Phone" required>

            <input type="password" name="password" id="password" placeholder="Mật khẩu" required>

            <input type="password" name="password2" id="password2" placeholder="Xác nhận mật khẩu" required>

            <button type="submit">Đăng Ký</button>
        </form>
        <p>Đã có tài khoản? <a href="?act=login">Đăng nhập ngay</a></p>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
