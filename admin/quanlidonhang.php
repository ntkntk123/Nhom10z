<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí khách hàng</title>
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

        .prev,
        .next {
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

        .prev:hover,
        .next:hover {
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
                <a href="?act=/" class="text-decoration-none text-dark fw-bold">Trang chủ</a>
                <a href="?act=sanpham" class="text-decoration-none text-dark fw-bold">Sản Phẩm</a>
                <a href="#" class="text-decoration-none text-dark fw-bold">Đồ Lót</a>
                <a href="#" class="text-decoration-none text-dark fw-bold">Đồ Mặc Hàng Ngày</a>
            </nav>
            <div class="d-flex gap-3">
                <input type="text" placeholder="Tìm kiếm sản phẩm..." class="form-control" style="width: 250px;">
                <div class="d-flex gap-4 align-items-center">
                    <!-- Kiểm tra nếu người dùng đã đăng nhập -->
                    <?php if (isset($_SESSION['username'])): ?>
                        <div class="dropdown">
                            <span class="text-dark fw-bold dropdown-toggle" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Chào mừng, <?php echo $_SESSION['username']; ?>!
                            </span>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="?act=profile">Thông tin khách hàng</a></li>
                                <li><a class="dropdown-item" href="?act=lsu">Lịch sử mua hàng</a></li>
                                <li><a class="dropdown-item" href="?act=cart">Giỏ hàng</a></li>
                                <li><a class="dropdown-item" href="?act=change_password">Đổi mật khẩu</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
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
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeUUz1pW3PpdJVcOvcwfYWdKFK4wBGL_UvcA&s"
                                alt="User Icon" class="user-icon bg-secondary rounded-circle"
                                style="width: 40px; height: 40px;">
                            <br>
                            <small>Đăng nhập</small>
                        </a>
                        <a href="?act=formRegister" class="text-decoration-none text-dark text-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeUUz1pW3PpdJVcOvcwfYWdKFK4wBGL_UvcA&s"
                                alt="User Icon" class="user-icon bg-secondary rounded-circle"
                                style="width: 40px; height: 40px;">
                            <br>
                            <small>Đăng ký</small>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>


    <div class="container-fluid mt-3">
        <div class="row">

            <div class="col-4">

                <div class="list-group">
                    <a href="?act=admin" class="list-group-item list-group-item-action list-group-item-info">Quản lí khách hàng</a>
                    <a href="#"
                        class="list-group-item list-group-item-action list-group-item-info">Quản lí danh mục</a>
                    <a href="?act=quanlisanpham"
                        class="list-group-item list-group-item-action list-group-item-info">Quản lí sản phẩm</a>
                    <a href="" class="list-group-item list-group-item-action list-group-item-info">Quản lí bình luận</a>
                    <a href="?act=quan-li-don-hang" class="list-group-item list-group-item-action list-group-item-info">Quản lí đơn hàng</a>
                    <a href="#" class="list-group-item list-group-item-action list-group-item-info">Quản lí</a>
                    <a href="#" class="list-group-item list-group-item-action list-group-item-info">Thống kê</a>
                </div>
            </div>
            <div class="col-8">
                <h1>Quản lí đơn hàng</h1>
                <a href="./?act=formAddUser"><button class="btn btn-success">Thêm đơn hàng</button></a>
                <table class="table table-striped table-bordered mt-3" border=1>
                    <thead>
                        <tr>
                            <th>ID đơn hàng</th>
                            <th>ID khách hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Tổng giá</th>
                            <th>Trạng thái</th>
                            <th>Địa chỉ giao hàng</th>     
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listDonhang as $key => $donhang): ?>
                            <tr>
                                <td><?php echo $donhang['id_don_hang']; ?></td>
                                <td><?php echo $donhang['id_nguoi_dung']; ?></td>
                                <td><?php echo $donhang['ngay_dat_hang']; ?></td>
                                <td><?php echo $donhang['tong_gia']; ?></td>
                                <td><?php if ($donhang['trang_thai'] == 1) {
                                    echo " Ẩn";
                                } else {
                                    echo "Hiện";
                                }
                                ?>
                                </td>
                                <td><?php echo $donhang['dia_chi_giao_hang']; ?></td>

                                <td>
                                    <a href="./?act=formUpdateUser&id_khach_hang=<?php echo $user['id_khach_hang']; ?>">
                                        <button class="btn btn-primary">Sửa</button>
                                    </a>
                                    <a href="./?act=deleteUser&id_khach_hang=<?php echo $user['id_khach_hang']; ?>">
                                        <button class="btn btn-warning" onclick="confirm('Bạn có muốn xóa')">Xóa</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>
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