<?php 
session_start();
// Require file Common
require_once './commonsz/env.php'; // Khai báo biến môi trường
require_once './commonsz/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/UserController.php';
// require_once './controllers/danhmucController.php';
// require_once './controllers/BinhluanController.php';


// Require toàn bộ file Models
require_once './models/Student.php';
require_once './models/User.php';
// require_once './models/danhmuc.php';
// require_once './models/binhLuan.php';


// Route
$act = $_GET['act'] ?? '/';

match ($act) {
    '/' => (new HomeController())->sanpham(),
    'profile' => (new HomeController())->profile(),
    'cart' => (new HomeController())->cart(),
    'lsu' => (new HomeController())->lsu(),
    'login'=>(new UserController())->login(),
    'logout'=>(new UserController())->logout(),

    'register'=>(new UserController())->register(),
    'formRegister'=>(new UserController())->formRegister(),
    'chitietsanpham'=>(new HomeController())->chitietsanpham(),
    'sanpham'=>(new HomeController())->hienThi(),
    'sanpham2'=>(new HomeController())->trangsanpham(),

    //phần user
    'quan-li-user'=>(new UserController())->listUser(),
    'formAddUser'=>(new UserController())->formAddUser(),
    'formUpdateUser'=>(new UserController())->formUpdateUser(),
    'updateUser'=>(new UserController())->postUpdateUser(),
    'deleteUser'=>(new UserController())->deleteUser(),
    'admin'=>(new UserController())->admin(),


    // 'quan-li-danh-muc'=>(new danhmucController())->danhmuc(),
    // 'form-add-danh-muc'=>(new danhmucController())->formDanhMuc(),
    // 'post-add-danh-muc'=>(new danhmucController())->postAddDanhMuc(),


    //sản phẩm
    'quanlisanpham'=>(new HomeController())->quanLiSanPham(),
    'formAddSanPham'=>(new HomeController())->formAddSanPham(),
    'post-add-sanpham'=>(new HomeController())->postAddSanPham(),
    'formUpdateSanPham'=>(new HomeController())->formUpdateSanPham(),
    'postUpdateSanPham'=>(new HomeController())->postUpdateSanPham(),
    'deleteSanPham'=>(new HomeController())->deleteSanPham(),
 
    //bình luận
    // 'chitietsanpham'=>(new BinhluanController())->showComments(),

    'binhluan'=>(new HomeController())->addBinhLuan(),
};