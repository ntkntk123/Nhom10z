<?php 

// Require file Common
require_once './commonsz/env.php'; // Khai báo biến môi trường
require_once './commonsz/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/UserController.php';

// Require toàn bộ file Models
require_once './models/Student.php';
require_once './models/User.php';

// Route
$act = $_GET['act'] ?? '/';

match ($act) {
    '/' => (new HomeController())->sanpham(),
    'login'=>(new UserController())->login(),
    'logout'=>(new UserController())->logout(),

    'register'=>(new UserController())->register(),
    'formRegister'=>(new UserController())->formRegister(),
};