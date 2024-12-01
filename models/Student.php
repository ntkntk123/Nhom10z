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
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc FROM san_pham
            INNER JOIN danh_muc ON san_pham.id_danh_muc = danh_muc.id_danh_muc
            WHERE san_pham.an_hien = 1';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getProducts()
    {
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc 
                FROM san_pham
                INNER JOIN danh_muc ON san_pham.id_danh_muc = danh_muc.id_danh_muc
                WHERE san_pham.an_hien = 1
                ORDER BY san_pham.create_at DESC
                LIMIT 8;';
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

    public function getSanPhamDanhMuc($categoryId)
    {
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

    public function postAddSanPham($ma_san_pham, $ten_san_pham, $id_danh_muc, $mo_ta, $gia, $trang_thai, $so_luong, $hinh_anh)
    {
        try {
            $sql = 'INSERT INTO san_pham (ma_san_pham, ten_san_pham, id_danh_muc, mo_ta, gia, trang_thai, so_luong, hinh_anh)
            VALUES(:ma_san_pham, :ten_san_pham, :id_danh_muc, :mo_ta, :gia, :trang_thai, :so_luong, :hinh_anh)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':ma_san_pham' => $ma_san_pham, ':ten_san_pham' => $ten_san_pham, ':id_danh_muc' => $id_danh_muc, ':gia' => $gia, ':trang_thai' => $trang_thai, ':mo_ta' => $mo_ta, ':so_luong' => $so_luong, ':hinh_anh' => $hinh_anh]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function postUpdateSanPham($id_san_pham, $ma_san_pham, $ten_san_pham, $gia, $so_luong, $id_danh_muc, $mo_ta, $trang_thai, $hinh_anh)
    {
        try {
            $sql = 'UPDATE san_pham 
                SET ma_san_pham = :ma_san_pham, 
                    ten_san_pham = :ten_san_pham, 
                    gia = :gia, 
                    so_luong = :so_luong, 
                    id_danh_muc = :id_danh_muc, 
                    mo_ta = :mo_ta, 
                    trang_thai = :trang_thai, 
                    hinh_anh = :hinh_anh
                WHERE id_san_pham = :id_san_pham';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id_san_pham' => htmlspecialchars($id_san_pham),
                ':ma_san_pham' => htmlspecialchars($ma_san_pham),
                ':ten_san_pham' => htmlspecialchars($ten_san_pham),
                ':gia' => $gia,
                ':so_luong' => $so_luong,
                ':id_danh_muc' => $id_danh_muc,
                ':mo_ta' => htmlspecialchars($mo_ta),
                ':trang_thai' => $trang_thai,
                ':hinh_anh' => $hinh_anh
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function deleteSanPham($id)
    {
        try {
            $sql = 'UPDATE san_pham SET an_hien = 0 WHERE id_san_pham = :id_san_pham';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id_san_pham' => $id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function getCommentsByProduct($id_san_pham)
    {
        try {
            $sql = 'SELECT binh_luan.*, khach_hang.ten_khach_hang FROM binh_luan
                INNER JOIN khach_hang ON binh_luan.id_khach_hang = khach_hang.id_khach_hang
                WHERE binh_luan.id_san_pham = :id_san_pham';
            $stmt = $this->conn->prepare($sql);
            // Liên kết giá trị id_san_pham vào câu truy vấn
            $stmt->bindParam(':id_san_pham', $id_san_pham, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function addBinhLuan($id_khach_hang, $id_san_pham, $noi_dung)
    {
        try {
            $sql = 'INSERT INTO binh_luan (id_khach_hang, id_san_pham, noi_dung, ngay_tao)
                    VALUES(:id_khach_hang, :id_san_pham, :noi_dung, NOW())';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id_khach_hang' => $id_khach_hang,
                ':id_san_pham' => $id_san_pham,
                ':noi_dung' => $noi_dung
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi chi tiết: " . $e->getMessage(); // Hiển thị lỗi
            error_log("Lỗi SQL: " . $e->getMessage()); // Ghi log lỗi
            return false;
        }
    }
    

    



}