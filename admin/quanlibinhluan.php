<?php
// session_start();
if($_SESSION['role']!=1){
    header("location: ./");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí sản phẩm</title>
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

            <div class="col-2">

                <div class="list-group">
                    <a href="?act=admin" class="list-group-item list-group-item-action list-group-item-info">Quản
                        lí khách hàng</a>
                    <a href="#" class="list-group-item list-group-item-action list-group-item-info">Quản lí danh mục</a>
                    <a href="?act=quanlisanpham"
                        class="list-group-item list-group-item-action list-group-item-info">Quản lí sản phẩm</a>
                    <a href="" class="list-group-item list-group-item-action list-group-item-info">Quản lí bình luận</a>
                    <a href="#" class="list-group-item list-group-item-action list-group-item-info">Quản lí</a>
                    <a href="#" class="list-group-item list-group-item-action list-group-item-info">Thống kê</a>
                </div>
            </div>
            <div class="col-10 mt-1">
                <h1 class="text-center mb-4">Danh Sách Sản Phẩm</h1>
                <div class="col-10">

                    <a href="./?act=formAddSanPham"><button class="btn btn-success">Thêm sản phẩm</button></a>
                    <table class="table table-striped table-bordered mt-3" border=1>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listProducts as $key => $product): ?>
                                <tr>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><?php echo $product['ten_san_pham']; ?></td>
                                    <td>
                                        <center><img style="width:100px; height:120px"
                                                src="<?php echo $product['hinh_anh']; ?>" alt=""
                                                onerror="this.onerror=null; this.src='data:image/jpeg;base64,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'">
                                        </center>
                                    </td>
                                    <td><?php echo $product['gia']; ?></td>

                                    <td>
                                        <a
                                            href="./?act=getbinhluansanpham&id_san_pham=<?php echo $product['id_san_pham']; ?>">
                                            <button class="btn btn-info">Xem</button>
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>
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