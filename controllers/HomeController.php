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

}