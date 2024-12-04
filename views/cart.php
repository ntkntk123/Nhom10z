<?php
// session_start(); // Remove this line if session_start() is already called elsewhere
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cập nhật giỏ hàng
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        foreach ($cart as &$item) {
            if ($item['id'] == $product_id) {
                $item['quantity'] = $quantity;
                break;
            }
        }
        $_SESSION['cart'] = $cart;
    }
    // Xóa sản phẩm khỏi giỏ hàng
    if (isset($_POST['remove_product_id'])) {
        $product_id = $_POST['remove_product_id'];
        foreach ($cart as $key => $item) {
            if ($item['id'] == $product_id) {
                unset($cart[$key]);
                break;
            }
        }
        $_SESSION['cart'] = $cart;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
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
            <a href="index.php?act=cart" class="text-decoration-none text-dark fw-bold">Giỏ hàng</a>
            <a href="../views/checkout.php" class="text-decoration-none text-dark fw-bold">Thanh toán</a>
        </nav>
    </div>
</header>

<div class="container mt-5">
    <?php if (!empty($cart)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $item):
                    // Ensure price is numeric before performing the calculation
                    $total += floatval($item['price']) * $item['quantity'];
                ?>
                    <tr>
                        <td><img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" height="80"></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>
                        <td>
                            <form action="index.php?act=cart" method="POST">
                                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" required>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </td>
                        <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> VNĐ</td>
                        <td>
                            <form action="index.php?act=cart" method="POST">
                                <input type="hidden" name="remove_product_id" value="<?= $item['id'] ?>">
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Tổng cộng: <?= number_format($total, 0, ',', '.') ?> VNĐ</h3>
        <a href="./index.php" class="btn btn-warning">Quay lại mua sắm</a>
        <a href="./views/checkout.php" class="btn btn-success">Thanh toán</a>
    <?php else: ?>
        <p>Giỏ hàng của bạn hiện đang trống.</p>
        <a href="./index.php" class="btn btn-warning">Quay lại mua sắm</a>
    <?php endif; ?>
</div>
</body>
</html>
