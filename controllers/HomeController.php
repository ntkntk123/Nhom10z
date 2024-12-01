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
    
    public function hienThi() {
        $danhmucs = $this->modelProducts->getDanhMuc();     
        if (empty($danhmucs)) {
            echo "Không có danh mục nào.";
            return;
        } 
        $sanPhamDanhMuc = [];
        foreach ($danhmucs as $danhmuc) {
            $sanPhamDanhMuc[$danhmuc['id_danh_muc']] = $this->modelProducts->getSanPhamDanhMuc($danhmuc['id_danh_muc']);
        }
        include 'views/sanpham.php'; 
    }

    public function quanLiSanPham(){
        $listProducts = $this->modelProducts->getAllProducts();
        require_once './admin/quanlisanpham.php';
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

    public function formAddSanPham(){
        $danhmucs = $this->modelProducts->getDanhMuc();  
        require_once './admin/formAddSanPham.php';
    }

    public function postAddSanPham(){
        if (isset($_POST['ten_san_pham'])) {
            $ma_san_pham=$_POST['ma_san_pham'];
            $ten_san_pham = $_POST['ten_san_pham'];
            $id_danh_muc=$_POST['id_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $gia = $_POST['gia'];
            $so_luong=$_POST['so_luong'];
            $trang_thai=$_POST['trang_thai'];
            $hinh_anh = $_FILES['hinh_anh'];
            if ($this->modelProducts->postAddSanPham($ma_san_pham, $ten_san_pham, $id_danh_muc, $mo_ta, $gia, $trang_thai, $so_luong, uploadFile($hinh_anh, './uploads/'))) {
                header("Location: ./");
            }
        }
    }
    

   
    



    
}