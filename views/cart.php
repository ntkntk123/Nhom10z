<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tùy chỉnh bảng giỏ hàng */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        td img {
            width: 80px;
            height: auto;
            object-fit: cover;
        }
        .cart-actions button {
            border: none;
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .cart-actions button:hover {
            background-color: #218838;
        }
        .cart-actions .remove {
            background-color: #dc3545;
        }
        .cart-actions .remove:hover {
            background-color: #c82333;
        }
        .cart-total {
            font-size: 20px;
            font-weight: bold;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            margin-top: 20px;
        }
        .cart-buttons {
    text-align: center; /* Căn giữa các nút */
    margin-top: 20px;
}

.cart-buttons a {
    display: inline-block; /* Đặt các nút cạnh nhau */
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
    transition: background-color 0.3s ease;
}

.cart-buttons a:hover {
    background-color: #0056b3;
}

.cart-buttons a:last-child {
    background-color: #dc3545; /* Nút Xoá Giỏ Hàng có màu đỏ */
}

.cart-buttons a:last-child:hover {
    background-color: #c82333; /* Màu hover của nút Xoá Giỏ Hàng */
}
footer {
    background-color: #f8f9fa;  /* Màu nền sáng cho footer */
    padding: 40px 0;  /* Thêm khoảng cách ở trên và dưới footer */
    text-align: center; /* Căn giữa nội dung trong footer */
    border-top: 1px solid #ddd;  /* Đường viền phía trên để phân biệt với nội dung trang */
}



    </style>
</head>
<body>

<header class="bg-white py-3 border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo"> <img src="https://sharesrc.pro/tao-logo/dep/view.php?text=Nh%C3%B3m10&color=1" alt="Logo"></div>
        <nav class="d-flex gap-4">
            <a href="?act=/" class="text-decoration-none text-dark fw-bold">Trang chủ</a>
            <a href="?act=sanpham" class="text-decoration-none text-dark fw-bold">Sản Phẩm</a>
            <a href="#" class="text-decoration-none text-dark fw-bold">Giỏ hàng</a>
            
        </nav>
        <div class="d-flex gap-3">
            <input type="text" placeholder="Tìm kiếm sản phẩm..." class="form-control" style="width: 250px;">
            <div class="d-flex gap-4 align-items-center">
                <?php if (isset($_SESSION['username'])): ?>
                    <div class="dropdown">
                        <span class="text-dark fw-bold dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Chào mừng, <?php echo $_SESSION['username']; ?>!
                        </span>
                        
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

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
            <?php
            $total = 0;
            foreach ($cart as $item):
                $total += $item['price'] * $item['quantity'];
            ?>
                <tr>
                    <td><img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" height="80"></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>
                    <td>
                        <form action="index.php?act=updateCart" method="POST">
                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" required>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </td>
                    <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> VNĐ</td>
                    <td>
                        <form action="index.php?act=dellcart" method="POST">
                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Tổng cộng: <?= number_format($total, 0, ',', '.') ?> VNĐ</h3>
     <a href="index.php?act=clearCart" class="btn btn-danger">Xóa toàn bộ giỏ hàng</a>
    <a href="index.php?act=checkout" class="btn btn-success">Thanh toán</a>
<?php else: ?>
    <p>Giỏ hàng của bạn hiện đang trống.</p>
<?php endif; ?>


     

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


</body>
</html>

