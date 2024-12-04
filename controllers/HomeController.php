<?php
class HomeController
{
    public $modelProducts;
    public $binhLuanModel;
 

    
    public function __construct()
    {
        $this->modelProducts = new Products();
        
    }
    public function sanpham()
    {
        $listProducts = $this->modelProducts->getAllProducts();
        require_once './views/trangchu.php';
    }
    public function quanlibinhluan()
    {
        $listProducts = $this->modelProducts->getAllProducts();
        require_once './admin/quanlibinhluan.php';
    }
    public function profile()
    {
        $listProducts = $this->modelProducts->getAllProducts();
        require_once './views/profile.php';
    }
    public function lsu()
    {
        $listProducts = $this->modelProducts->getAllProducts();
        require_once './views/lsu.php';
    }
    public function trangsanpham()
    {
        $listProducts = $this->modelProducts->getProducts();
        require_once './views/sanpham2.php';
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
    public function quanLiSanPham()
    {
        $listProducts = $this->modelProducts->getAllProducts();
        require_once './admin/quanlisanpham.php';
    }

    public function chitietsanpham()
    {
        $id = $_GET['id_san_pham'];        
        $product = $this->modelProducts->getIdSanPham($id);
        $comments = $this->modelProducts->getCommentsByProduct($id);
        // var_dump($id);
        // var_dump($sanpham);
        if ($product) {
            // var_dump($sanpham)  ;
            
            require_once "./views/chitietsanpham.php";
        } else {
            header("Location: ?act=sanpham");
        }
    }

    public function formAddSanPham()
    {
        $danhmucs = $this->modelProducts->getDanhMuc();
        require_once './admin/formAddSanPham.php';
        // deleteSessionError();
    }

    public function postAddSanPham()
    {

        if (isset($_POST['ten_san_pham'])) {
            
            $ten_san_pham = $_POST['ten_san_pham'] ?? '' ;
            $id_danh_muc = $_POST['id_danh_muc'] ?? '' ;
            $mo_ta = $_POST['mo_ta'] ?? '';
            $gia = $_POST['gia'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $hinh_anh = $_FILES['hinh_anh'] ?? null;


            $img_array = $_FILES['img_array'];

            $err = [];
          
            if (empty($ten_san_pham)) {
                $err['ten_san_pham'] = "Tên sản phẩm không được bỏ trống.";
            }
            if (empty($id_danh_muc)) {
                $err['id_danh_muc'] = "Vui lòng chọn danh mục.";
            }
            if (empty($gia)) {
                $err['gia'] = "Giá sản phẩm không được bỏ trống.";
            }
            if (empty($so_luong)) {
                $err['so_luong'] = "Số lượng sản phẩm không được để trống.";
            }
            if (empty($trang_thai)) {
                $err['trang_thai'] = "Vui lòng chọn trạng thái";
            }
            // if ($hinh_anh['error'] !== 0) {
            //     $err['hinh_anh'] = "Chọn hình ảnh.";
            // }

            // $_SESSION['err'] = $err;

            if (empty($err)) {
                $this->modelProducts->postAddSanPham( $ten_san_pham, $id_danh_muc, $mo_ta, $gia, $trang_thai, $so_luong, uploadFile($hinh_anh, './uploads/'));
                header("Location: ?act=quanlisanpham");
            } else {
                require_once './admin/formAddSanPham.php';
                // $_SESSION['flash'] = true;
                // header("location: ?act=quanlisanpham");
            }


            // if ($this->modelProducts->postAddSanPham($ma_san_pham, $ten_san_pham, $id_danh_muc, $mo_ta, $gia, $trang_thai, $so_luong, uploadFile($hinh_anh, './uploads/'))) {
            //     header("Location: ./");
            // }
        }
    }



 

    public function formUpdateSanPham()
    {
        $id = $_GET['id_san_pham'];
        $product = $this->modelProducts->getIdSanPham($id);
        $danhmucs = $this->modelProducts->getDanhMuc();
        require_once './admin/formUpdateSanPham.php';
    }


    public function postUpdateSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $id_san_pham = $_POST['id_san_pham'];
            
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia = $_POST['gia'];
            $so_luong = $_POST['so_luong'];
            $id_danh_muc = $_POST['id_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];
            $old_image = $_POST['old_hinh_anh'];

            // Xử lý ảnh
            $hinh_anh = $_FILES['hinh_anh'];
            if (isset($hinh_anh) && $hinh_anh['error'] === 0) {
                $new_image = uploadFile($hinh_anh, './uploads/');
                if (!empty($old_image)) {
                    deleteFile($old_image);
                }
            } else {
                $new_image = $old_image;
            }

            // Gửi dữ liệu đến model để cập nhật       
            if ($this->modelProducts->postUpdateSanPham($id_san_pham, $ten_san_pham, $gia, $so_luong, $id_danh_muc, $mo_ta, $trang_thai, $new_image)) {
                header("Location: ?act=quanlisanpham");
            }
        }
    }

    public function deleteSanPham(){
        $id = $_GET['id_san_pham'];
        if ($this->modelProducts->deleteSanPham($id)) {
            header("Location: ?act=quanlisanpham");
            
        }
    }

    public function showComments()
    {
        $id = $_GET['id_san_pham'] ?? null;
        if (!$id) {
            echo "ID sản phẩm không hợp lệ!";
            return;
        }
        $comments = $this->modelProducts->getCommentsByProduct($id);

    }

    public function addBinhLuan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
    
            
            if (isset($_SESSION['id_khach_hang'])) {
                $id_khach_hang = $_SESSION['id_khach_hang']; 
            } else {
                echo "Lỗi: Vui lòng đăng nhập trước khi bình luận.";
                return;
            }
    
            
            $id_san_pham = $_POST['id_san_pham'] ?? null; 
            $noi_dung = trim($_POST['noi_dung'] ?? ''); 
    
            if (empty($id_san_pham) || empty($noi_dung)) {
                echo "Lỗi: Vui lòng nhập nội dung bình luận và chọn sản phẩm.";
                return;
            }

            if ($this->modelProducts->addBinhLuan($id_khach_hang, $id_san_pham, $noi_dung)) {
                header("Location: ?act=chitietsanpham&id_san_pham=$id_san_pham");
                exit();
            } else {

                var_dump($id_san_pham);
                var_dump($noi_dung);
                echo "Lỗi: Không thể thêm bình luận, vui lòng thử lại.";
            }
        }
    }

    public function binhLuanTheoSanPham()
    {
        $id = $_GET['id_san_pham'];        
        $product = $this->modelProducts->getIdSanPham($id);
        $comments = $this->modelProducts->getCommentsByProduct($id);
        if ($product) { 
            require_once "./admin/binhluan.php";
        } else {
            header("Location: ?act=sanpham");
        }
    }
    

    public function xoaBinhLuan(){
        $id = $_GET['id_binh_luan']; 
        if ($this->modelProducts->xoaBinhLuan($id)) {
            header("Location: ?act=quanlibinhluan");
        }
    }

}