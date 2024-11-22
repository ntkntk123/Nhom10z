<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Men's Clothing Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo {
            width: 40px;
            height: 40px;
            background-color: #e0e0e0;
            margin-right: 10px;
        }
        .slideshow-container {
            position: relative;
            max-width: 100%;
            margin: 20px auto;
            overflow: hidden;
            border-radius: 10px;
        }
        .slideshow-container img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: 40px;
            height: 40px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            font-size: 24px;
            font-weight: bold;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            transition: 0.3s;
            z-index: 1000;
        }
        .prev {
            left: 10px;
        }
        .next {
            right: 10px;
        }
        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        footer {
            background-color: #f1f1f1;
            padding: 20px;
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
                <a href="?act=login" class="text-decoration-none text-dark fw-bold">Đăng nhập</a>
                <?php if (isset($_SESSION['username'])) {
            echo "Chào mừng, " . $_SESSION['username'] . "!";
            echo ' <a href="?act=logout" class="text-decoration-none text-dark fw-bold">Đăng xuat</a>';
            
          } ?>
         
                <?php

if (isset($_SESSION['username'])) {
  $role = $_SESSION['role'];
  if ($role == 1) {
    echo  ' <li class="nav-item">
  <a  href="?act=admin">Quản lí admin</a>
</li>';
 

}}
?>
            </nav>
            <div class="d-flex gap-3">
                <input type="text" placeholder="Tìm kiếm sản phẩm..." class="form-control" style="width: 250px;">
                <div class="d-flex gap-2">
                    <div class="cart-icon bg-secondary rounded-circle" style="width: 24px; height: 24px;"></div>
                    <div class="user-icon bg-secondary rounded-circle" style="width: 24px; height: 24px;"></div>
                </div>
            </div>
        </div>
    </header>
    <div class="slideshow-container">
        <div class="slides">
            <img src="https://via.placeholder.com/800x400?text=New+Arrivals" alt="Slide 1">
        </div>
        <div class="slides">
            <img src="https://via.placeholder.com/800x400?text=Big+Discounts" alt="Slide 2">
        </div>
        <div class="slides">
            <img src="https://via.placeholder.com/800x400?text=Summer+Collection" alt="Slide 3">
        </div>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <?php if (!empty($danhmucs)): ?>
        <?php foreach ($danhmucs as $danhmuc): ?>
            <h2><?php echo htmlspecialchars($danhmuc['ten_danh_muc']); ?></h2> <!-- Hiển thị tên danh mục -->
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php if (!empty($sanPhamDanhMuc[$danhmuc['id_danh_muc']])): ?>
                    <?php foreach ($sanPhamDanhMuc[$danhmuc['id_danh_muc']] as $sanpham): ?>
                        <div class="col">
                            <div class="card h-100">
                                <a href="./?act=chitietsanpham&id_san_pham=<?php echo $sanpham['id_san_pham']; ?>">
                                    <img src="<?php echo htmlspecialchars($sanpham['hinh_anh']); ?>" class="card-img-top"
                                        alt="<?php echo htmlspecialchars($sanpham['ten_san_pham']); ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($sanpham['ten_san_pham']); ?></h5>
                                    <p class="card-text">Giá: <strong><?php echo number_format($sanpham['gia'], 0, ',', '.'); ?>
                                            VND</strong></p>
                                    <div class="d-flex justify-content-between">
                                        <a href="./?act=chitietsanpham&id_san_pham=<?php echo $sanpham['id_san_pham']; ?>"
                                            class="btn btn-primary">Mua ngay</a>
                                        <button onclick="addToCart(<?php echo $sanpham['id_san_pham']; ?>)"
                                            class="btn btn-secondary">Thêm vào giỏ hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có sản phẩm nào trong danh mục này.</p>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có danh mục nào.</p>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }
        function showSlides(n) {
            let slides = document.getElementsByClassName("slides");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }
    </script>
</body>
</html>
