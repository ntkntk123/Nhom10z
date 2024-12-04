<?php
// session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ./login/login.php");
    exit;
}

require_once 'db.php';

// Lấy ID khách hàng từ bảng khach_hang
$stmt = $conn->prepare("SELECT id_khach_hang FROM khach_hang WHERE username = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Không tìm thấy người dùng!";
    exit;
}

$id_khach_hang = $user['id_khach_hang'];

// Lấy thông tin đơn hàng của khách hàng
$stmt = $conn->prepare("SELECT * FROM don_hang WHERE id_khach_hang = :id_khach_hang");
$stmt->bindParam(':id_khach_hang', $id_khach_hang);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$orders) {
    echo "Không có đơn hàng nào!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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

        .order-history-table {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .order-history-table h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #007bff;
        }

        .order-history-table th, .order-history-table td {
            text-align: center;
            vertical-align: middle;
        }

        .order-history-table thead {
            background-color: #007bff;
            color: white;
        }

        .order-history-table .badge {
            font-size: 0.9rem;
        }

        .order-history-table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        footer {
            background-color: #f1f1f1;
            padding: 40px 0;
            margin-top: 50px;
        }

        footer .footer-section h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
        }

        footer .footer-section p {
            color: #666;
            font-size: 14px;
        }

        footer .footer-section a {
            color: #007bff;
            text-decoration: none;
        }

        footer .footer-section a:hover {
            text-decoration: underline;
        }

        footer .feedback-button {
            background-color: #dc3545;
            color: #fff;
            font-size: 16px;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            width: 100%;
        }

        footer .feedback-button:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            header .container {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-history-table {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

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
                <?php else: ?>
                    <a href="?act=login" class="text-decoration-none text-dark text-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeUUz1pW3PpdJVcOvcwfYWdKFK4wBGL_UvcA&s" alt="User Icon" class="user-icon bg-secondary rounded-circle" style="width: 40px; height: 40px;">
                        <br>
                        <small>Đăng nhập</small>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<div class="container my-5">
    <div class="order-history-table">
        <h2 class="text-center">Lịch Sử Đơn Hàng</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Đơn Hàng</th>
                    <th>Ngày Đặt Hàng</th>
                    <th>Tổng Giá</th>
                    <th>SDT</th>
                    <th>Địa Chỉ Nhận Hàng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($orders) > 0) {
                    $stt = 1;
                    foreach ($orders as $order) {
                        // Chuyển đổi trạng thái thành văn bản
                       
                        echo "<tr>";
                        echo "<td>" . $stt . "</td>";
                        echo "<td>" . htmlspecialchars($order['id_don_hang']) . "</td>";
                        echo "<td>" . htmlspecialchars($order['ngay_dat_hang']) . "</td>";
                        echo "<td>" . number_format($order['tong_tien'], 0, ',', '.') . " VNĐ</td>";
                        echo "<td>" . htmlspecialchars($order['phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($order['dia_chi']) . "</td>";
                        echo "</tr>";

                        $stt++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

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
    <button class="feedback-button">Give Feedback</button>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
