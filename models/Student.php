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

    public function getAllComments() {
        $stmt = $this->conn->prepare("SELECT * FROM binh_luan ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addComment($id_khach_hang, $id_san_pham, $noi_dung) {
        $stmt = $this->conn->prepare("INSERT INTO binh_luan (id_khach_hang, id_san_pham, noi_dung, created_at) VALUES (:author, :id_san_pham, :noi_dung, NOW())");
        return $stmt->execute(['id_khach_hang' => $id_khach_hang,'id_san_pham'=>$id_san_pham , 'noi_dung' => $noi_dung]);
    }
    
}