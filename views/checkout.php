<?php
session_start();
require_once 'db1.php'; // Kết nối cơ sở dữ liệu (db_config.php)

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Lấy thông tin giỏ hàng và tính tổng tiền
$cart = $_SESSION['cart'];
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Lấy id_khach_hang từ session hoặc giỏ hàng
$id_khach_hang = $_SESSION['id_khach_hang']; // Giả sử `id_khach_hang` đã được lưu trong session khi khách hàng đăng nhập.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin khách hàng và phương thức thanh toán
    $ten_khach_hang = $_POST['ten_khach_hang'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dia_chi = $_POST['dia_chi'];
    $payment_method = $_POST['payment_method'];

    // Kết nối cơ sở dữ liệu và chèn đơn hàng vào bảng don_hang
    $sql = "INSERT INTO don_hang (id_khach_hang, ten_khach_hang, email, phone, dia_chi, payment_method, tong_tien)
            VALUES (:id_khach_hang, :ten_khach_hang, :email, :phone, :dia_chi, :payment_method, :tong_tien)";
    
    if ($stmt = $conn->prepare($sql)) {
        // Sử dụng bindValue hoặc bindParam để gán giá trị cho các tham số
        $stmt->bindValue(':id_khach_hang', $id_khach_hang, PDO::PARAM_INT); // Lấy id_khach_hang từ session
        $stmt->bindValue(':ten_khach_hang', $ten_khach_hang, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':dia_chi', $dia_chi, PDO::PARAM_STR);
        $stmt->bindValue(':payment_method', $payment_method, PDO::PARAM_STR);
        $stmt->bindValue(':tong_tien', $total, PDO::PARAM_STR); // Nếu `tong_tien` là số, bạn có thể dùng PDO::PARAM_INT

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            // Lấy ID của đơn hàng vừa tạo
            $id_don_hang = $conn->lastInsertId();

            // Lưu thông tin sản phẩm vào bảng chi_tiet_don_hang
            $sql_details = "INSERT INTO chi_tiet_don_hang (id_don_hang, id_san_pham, so_luong, gia) 
                            VALUES (:id_don_hang, :id_san_pham, :so_luong, :gia)";
            
            foreach ($cart as $item) {
                if ($details_stmt = $conn->prepare($sql_details)) {
                    $details_stmt->bindValue(':id_don_hang', $id_don_hang, PDO::PARAM_INT);
                    $details_stmt->bindValue(':id_san_pham', $item['id'], PDO::PARAM_INT);
                    $details_stmt->bindValue(':so_luong', $item['quantity'], PDO::PARAM_INT);
                    $details_stmt->bindValue(':gia', $item['price'], PDO::PARAM_STR);
                    $details_stmt->execute();
                }
            }

            // Lưu thành công, xóa giỏ hàng khỏi session
            unset($_SESSION['cart']);
            header("Location: thanhcong.php"); // Chuyển hướng tới trang thành công
            exit();
        } else {
            $error_message = "Lỗi trong quá trình lưu đơn hàng. Vui lòng thử lại!";
        }
    } else {
        $error_message = "Không thể kết nối tới cơ sở dữ liệu!";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-white py-3 border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <img src="https://sharesrc.pro/tao-logo/dep/view.php?text=Nh%C3%B3m10&color=1" alt="Logo">
        </div>
        <nav class="d-flex gap-4">
            <a href="index.php" class="text-decoration-none text-dark fw-bold">Trang chủ</a>
            <a href="cart.php" class="text-decoration-none text-dark fw-bold">Giỏ hàng</a>
            <a href="checkout.php" class="text-decoration-none text-dark fw-bold">Thanh toán</a>
        </nav>
    </div>
</header>

<div class="container mt-5">
    <h2 class="text-center">Thông tin thanh toán</h2>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?= $error_message; ?></div>
    <?php endif; ?>
    <form action="checkout.php" method="POST">
        <div class="row">
            <div class="col-md-6">
                <h4>Thông tin khách hàng</h4>
                <div class="mb-3">
                    <label for="ten_khach_hang" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" id="ten_khach_hang" name="ten_khach_hang" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Điện thoại</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="dia_chi" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="dia_chi" name="dia_chi" required>
                </div>
                <h4>Hình thức thanh toán</h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="cash" value="Tiền mặt" required>
                    <label class="form-check-label" for="cash">Tiền mặt</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="bank" value="Chuyển khoản" required>
                    <label class="form-check-label" for="bank">Chuyển khoản</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="Ship COD" required>
                    <label class="form-check-label" for="cod">Ship COD</label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg mt-4">Đặt hàng</button>
            </div>
            <div class="col-md-6">
                <h4>Giỏ hàng</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th class="text-end">Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td class="text-end"><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Tổng thành tiền</strong></td>
                            <td class="text-end"><strong><?= number_format($total, 0, ',', '.') ?> VNĐ</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </form>
</div>
</body>
</html>
