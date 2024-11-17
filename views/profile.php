<?php
// profile.php

// Khởi động session để kiểm tra nếu người dùng đã đăng nhập
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập thì chuyển hướng đến trang login
if (!isset($_SESSION['username'])) {
    header("Location: ./login/login.php");
    exit;
}

// Bao gồm file kết nối cơ sở dữ liệu
require_once 'db.php';

// Lấy thông tin người dùng từ cơ sở dữ liệu
$stmt = $conn->prepare("SELECT * FROM khach_hang WHERE username = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra nếu có dữ liệu trả về
if (!$user) {
    echo "Không tìm thấy thông tin người dùng!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Chung cho toàn bộ trang */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #fff;
            padding: 20px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 40px;
            height: 40px;
            background-color: #007bff;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Header Navigation */
        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .container nav {
            font-size: 16px;
            display: flex;
            gap: 20px;
        }

        header .container nav a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        header .container nav a:hover {
            color: #007bff;
        }

        /* Tạo khung đẹp cho phần thông tin người dùng */
        .profile-card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .profile-card h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #007bff;
        }

        .profile-card .user-info {
            margin-bottom: 20px;
        }

        .profile-card .user-info p {
            font-size: 16px;
            color: #333;
            margin: 8px 0;
        }

        .profile-card .user-info strong {
            color: #007bff;
        }

        /* Cải thiện style nút đăng xuất */
        .logout-btn {
            background-color: #ff4d4d;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #ff3333;
        }

        /* Footer */
        footer {
            background-color: #f1f1f1;
            padding: 30px 0;
            margin-top: 40px;
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
            .profile-card {
                padding: 20px;
            }

            .profile-card h2 {
                font-size: 24px;
            }

            .profile-card .user-info p {
                font-size: 14px;
            }

            .logout-btn {
                padding: 8px 12px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

<!-- Phần Header -->
<header class="bg-white py-3 border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
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
                <!-- Kiểm tra nếu người dùng đã đăng nhập -->
                <?php if (isset($_SESSION['username'])): ?>
                    <div class="dropdown">
                        <span class="text-dark fw-bold dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Chào mừng, <?php echo $_SESSION['username']; ?>!
                        </span>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="?act=profile">Thông tin khách hàng</a></li>
                            <li><a class="dropdown-item" href="?act=lsu">Lịch sử mua hàng</a></li>
                            <li><a class="dropdown-item" href="?act=cart">Giỏ hàng</a></li>
                            <li><a class="dropdown-item" href="?act=change_password">Đổi mật khẩu</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="?act=logout">Đăng xuất</a></li>
                        </ul>
                    </div>

                    <!-- Kiểm tra quyền admin -->
                    <?php if ($_SESSION['role'] == 1): ?>
                        <li class="nav-item">
                            <a href="?act=admin" class="text-decoration-none text-dark fw-bold">Quản lý admin</a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Nếu chưa đăng nhập, hiển thị Đăng nhập và Đăng ký -->
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
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<!-- Phần Nội Dung -->
<div class="container my-5">
    <div class="profile-card">
        <h2 class="text-center">Thông Tin Khách Hàng</h2>
        <div class="user-info">
            <p><strong>Tên:</strong> <?php echo htmlspecialchars($user['ten_khach_hang']); ?></p>
            <p><strong>Phone:</strong> <?php $user['phone'] ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        </div>

    </div>
</div>

<!-- Phần Footer -->
<footer>
    <div class="container d-flex justify-content-between">
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
