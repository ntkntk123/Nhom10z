<?php 

class HomeController
{
    public $modelProducts;
    public function __construct()
    {
        $this->modelProducts = new Products();
    }

    public function sanpham(){
        $listProducts = $this->modelProducts->getAllProducts();
        require_once './views/trangchu.php';
    }
    public function profile(){
        $listProducts = $this->modelProducts->getAllProducts();
        require_once './views/profile.php';
    }
    public function lsu(){
        $listProducts = $this->modelProducts->getAllProducts();
        require_once './views/lsu.php';
    }
    public function cart(){
        $listProducts = $this->modelProducts->getAllProducts();
        require_once './views/giohang.php';
    }

}