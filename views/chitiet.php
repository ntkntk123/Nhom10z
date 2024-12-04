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

// Nếu không có đơn hàng
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
    <title>Chi Tiết Đơn Hàng</title>
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
            <a href="#">Trang Chủ</a>
            <a href="#">Sản Phẩm</a>
            <a href="#">Giỏ Hàng</a>
        </nav>
    </div>
</header>

<div class="container my-5">
    <div class="order-history-table">
        <h2 class="text-center">Chi Tiết Đơn Hàng</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Sản Phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                    <th>Tổng Tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 1;
                foreach ($orders as $order) {
                    $id_don_hang = $order['id_don_hang'];

                    // Lấy chi tiết đơn hàng
                    $stmt = $conn->prepare("SELECT ct.id_san_pham, sp.ten_san_pham, ct.so_luong, ct.gia 
                                            FROM chi_tiet_don_hang ct
                                            JOIN san_pham sp ON ct.id_san_pham = sp.id_san_pham
                                            WHERE ct.id_don_hang = :id_don_hang");
                    $stmt->bindParam(':id_don_hang', $id_don_hang);
                    $stmt->execute();
                    $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Hiển thị chi tiết từng sản phẩm trong đơn hàng
                    foreach ($orderDetails as $detail) {
                        $totalPrice = $detail['so_luong'] * $detail['gia'];
                        echo "<tr>";
                        echo "<td>" . $stt . "</td>";
                        echo "<td>" . htmlspecialchars($detail['id_san_pham']) . "</td>";
                        echo "<td>" . htmlspecialchars($detail['ten_san_pham']) . "</td>";
                        echo "<td>" . htmlspecialchars($detail['so_luong']) . "</td>";
                        echo "<td>" . number_format($detail['gia'], 0, ',', '.') . " VNĐ</td>";
                        echo "<td>" . number_format($totalPrice, 0, ',', '.') . " VNĐ</td>";
                        echo "</tr>";
                        $stt++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
