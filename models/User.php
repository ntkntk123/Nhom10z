<?php
class User
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllUser()
    {
        try {
            $sql = 'SELECT * FROM khach_hang WHERE trang_thai=0';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM khach_hang WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function postRegister($ten_khach_hang, $user, $pass, $phone, $email)
    {
        // Biến lưu trữ thông báo lỗi
        $errUser = '';
        
        try {
            // Kiểm tra xem username đã tồn tại chưa
            $sqlCheck = 'SELECT COUNT(*) FROM khach_hang WHERE username = :username';
            $stmtCheck = $this->conn->prepare($sqlCheck);
            $stmtCheck->execute([':username' => $user]);
            $count = $stmtCheck->fetchColumn();
            
            if ($count > 0) {
                // Nếu username đã tồn tại, gán thông báo lỗi vào biến $errUser
                $errUser = "Tên người dùng đã tồn tại.";
                return $errUser;  // Trả về thông báo lỗi
            }
    
            // Nếu username chưa tồn tại, thực hiện câu lệnh INSERT
            $sql = 'INSERT INTO khach_hang (ten_khach_hang, username, phone, password, email)
                    VALUES(:ten_khach_hang, :username, :phone, :password, :email)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_khach_hang' => $ten_khach_hang,
                ':username' => $user,
                ':phone' => $phone,
                ':password' => $pass,
                ':email' => $email
            ]);
    
            return true;
        } catch (Exception $e) {
            // Lỗi xảy ra, gán thông báo lỗi vào biến $errUser
            $errUser = "Lỗi: " . $e->getMessage();
            return $errUser;
        }
    }
    
    //lấy id để sửa
    public function getUserId($id)
    {
        try {
            $sql = 'SELECT * FROM khach_hang WHERE id_khach_hang=:id_khach_hang';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id_khach_hang' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function postUpdateUser($id, $trang_thai, $role)
    {
        try {
            $sql = 'UPDATE khach_hang SET trang_thai=:trang_thai, role=:role
            WHERE id_khach_hang=:id_khach_hang';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id_khach_hang' => $id,  ':trang_thai' => $trang_thai, ':role' => $role]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function deleteUser($id)
    {
        try {
            $sql = 'UPDATE khach_hang SET trang_thai = 1 WHERE id_khach_hang = :id_khach_hang';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id_khach_hang' => $id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    
}
?>