<?php 

class Products 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllProducts()
    {
        try {
            $sql = 'SELECT * FROM san_pham';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
   
    public function getDanhMuc()
    {
        try {
            $sql = 'SELECT * FROM danh_muc';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getSanPhamDanhMuc($categoryId) {
        $sql = "SELECT * FROM san_pham WHERE id_danh_muc = :id_danh_muc";  
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_danh_muc', $categoryId, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getIdSanPham($id)
    {
        try {
            $sql = 'SELECT * FROM san_pham WHERE id_san_pham=:id_san_pham';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id_san_pham' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    

    public function postAddSanPham($ma_san_pham, $ten_san_pham, $id_danh_muc, $mo_ta, $gia, $trang_thai, $so_luong, $hinh_anh){
        try {
            $sql = 'INSERT INTO san_pham (ma_san_pham, ten_san_pham, id_danh_muc, mo_ta, gia, trang_thai, so_luong, hinh_anh)
            VALUES(:ma_san_pham, :ten_san_pham, :id_danh_muc, :mo_ta, :gia, :trang_thai, :so_luong, :hinh_anh)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':ma_san_pham'=>$ma_san_pham, ':ten_san_pham'=>$ten_san_pham, ':id_danh_muc'=>$id_danh_muc, ':gia'=>$gia, ':trang_thai'=>$trang_thai,':mo_ta'=>$mo_ta, ':so_luong'=>$so_luong , ':hinh_anh'=>$hinh_anh]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: ". $e->getMessage();
        }
    }

}