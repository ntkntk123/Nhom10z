<?php

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/UserController.php';
require_once './controllers/sanphamController.php';
require_once './controllers/danhmucController.php';

// Require toàn bộ file Models
require_once './models/User.php';
require_once './models/Products.php';
require_once './models/danhmuc.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new sanphamController())->sanpham(),
    'san-pham'=>(new sanphamController())->sanpham(),

    // Đăng nhập
    'login' => (new UserController())->login(),

    //form đăng kí
    'formRegister' => (new UserController())->formRegister(),
    'register' => (new UserController())->register(),
    'admin'=>(new UserController())->admin(),
    //logic

    // quản lí khách hàng 
    //danh sách user
    'quan-li-user' => (new UserController())->listUser(),
    'form-add-user' => (new UserController())->formAddUser(),

    'post-add-user' => (new UserController())->postAddUser(),

    'form-update-user' => (new UserController())->formUpdateUser(),

    'post-update-user' => (new UserController())->postUpdateUser(),

    'delete-user' => (new UserController())->deleteUser(),


//quản lí danh mục
    'quan-li-danh-muc'=>(new danhmucController())->danhmuc(),
    'form-add-danh-muc'=>(new danhmucController())->formDanhMuc(),
    'post-add-danh-muc'=>(new danhmucController())->postAddDanhMuc(),
//quản lí sản phẩm

//quản lí bình luận

//thống kê

};