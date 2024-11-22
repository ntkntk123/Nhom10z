<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ./login/login.php");
    exit;
}

require_once 'db.php';

// Kiểm tra nếu giỏ hàng tồn tại trong session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['remove'])) {
        $product_id = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]); // Xóa sản phẩm khỏi giỏ hàng
    }
    
    if (isset($_POST['update'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        if ($quantity > 0) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity; // Cập nhật số lượng
        }
    }
}

// Lấy thông tin sản phẩm từ giỏ hàng
$product_ids = array_keys($_SESSION['cart']);
$products = [];

if (!empty($product_ids)) {
    $stmt = $conn->prepare("SELECT * FROM san_pham WHERE id IN (" . implode(',', $product_ids) . ")");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $products = [];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        header {
            background-color: #fff;
            padding: 20px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-table {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .cart-table h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #007bff;
        }

        .cart-table th, .cart-table td {
            text-align: center;
            vertical-align: middle;
        }

        .cart-table thead {
            background-color: #007bff;
            color: white;
        }

        .cart-table tbody tr:hover {
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
    <div class="cart-table">
        <h2 class="text-center">Giỏ Hàng</h2>
        <?php if (empty($products)): ?>
            <p class="text-center">Giỏ hàng của bạn hiện tại trống.</p>
        <?php else: ?>
        <form method="POST" action="">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Tổng Tiền</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price = 0;
                    $stt = 1;
                    foreach ($products as $product) {
                        $product_id = $product['id'];
                        $quantity = $_SESSION['cart'][$product_id]['quantity'];
                        $price = $product['price'];
                        $total = $price * $quantity;
                        $total_price += $total;
                    ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td>
                            <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" max="100">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        </td>
                        <td><?php echo number_format($price, 0, ',', '.') . " VNĐ"; ?></td>
                        <td><?php echo number_format($total, 0, ',', '.') . " VNĐ"; ?></td>
                        <td>
                            <button type="submit" name="update" class="btn btn-warning btn-sm">Cập nhật</button>
                            <button type="submit" name="remove" class="btn btn-danger btn-sm" value="remove">Xóa</button>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Tổng Tiền:</strong></td>
                        <td><strong><?php echo number_format($total_price, 0, ',', '.') . " VNĐ"; ?></strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <a href="checkout.php" class="btn btn-success btn-lg d-block mx-auto">Thanh Toán</a>
        </form>
        <?php endif; ?>
    </div>
</div>

<footer>
    <div class="container text-center">
        <div class="footer-section">
            <h3>Feedback</h3>
            <p>Hãy cho chúng tôi biết nếu có bất kỳ thắc mắc nào về sản phẩm.</p>
            <button class="feedback-button">Gửi Phản Hồi</button>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
