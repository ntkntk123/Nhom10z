<?php
class Donhangcontroller{
    public $modelDonhang;

    public function __construct(){
        $this->modelDonhang = new Donhang();
    }

    // quản lí đơn hàng
    public function listDonhang(){
        $listDonhang = $this->modelDonhang->getAllDonhang();
        // var_dump($listDonhang);
        
        require_once './admin/quanlidonhang.php';
    }
}

?>