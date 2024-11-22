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
    public function hienThi() {
        $danhmucs = $this->modelProducts->getDanhMuc();  // Lấy danh sách danh mục
        if (empty($danhmucs)) {
            echo "Không có danh mục nào.";  // Kiểm tra nếu không có danh mục
            return;
        }
    
        $sanPhamDanhMuc = [];
        foreach ($danhmucs as $danhmuc) {
            $sanPhamDanhMuc[$danhmuc['id_danh_muc']] = $this->modelProducts->getSanPhamDanhMuc($danhmuc['id_danh_muc']);
        }
    
        // Log kiểm tra dữ liệu
        // echo '<pre>';
        // print_r($danhmucs); // Log danh mục
        // print_r($sanPhamDanhMuc); // Log sản phẩm theo danh mục
        // echo '</pre>';
    
        include 'views/sanpham.php';  // Truyền dữ liệu tới view để hiển thị
    }

    public function chitietsanpham(){
        $id=$_GET['id_san_pham'];
        $sanpham=$this->modelProducts->getIdSanPham($id);
        // var_dump($id);
        // var_dump($sanpham);
        if($sanpham){        
            // var_dump($sanpham)  ;
            require_once "./views/chitietsanpham.php";
        }
    }



    
}