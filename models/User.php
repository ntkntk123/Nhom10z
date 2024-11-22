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

    public function postRegister($ten_khach_hang, $user, $pass, $email, $pass2)
    {
        try {
            $sql = 'INSERT INTO khach_hang ( ten_khach_hang, username,  password, email)
                VALUES(:ten_khach_hang, :username, :password, :email)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':ten_khach_hang' => $ten_khach_hang, ':username' => $user, ':email' => $email, ':password' => $pass]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
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


    public function postUpdateUser($id, $ten_khach_hang, $user, $pass, $email, $phone, $trang_thai, $role)
    {
        try {
            $sql = 'UPDATE khach_hang SET  ten_khach_hang=:ten_khach_hang, username=:username, password=:password , email=:email, phone=:phone, trang_thai=:trang_thai, role=:role
            WHERE id_khach_hang=:id_khach_hang';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id_khach_hang' => $id, ':ten_khach_hang' => $ten_khach_hang, ':username' => $user, ':email' => $email, ':phone' => $phone, ':password' => $pass, ':trang_thai' => $trang_thai, ':role' => $role]);
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

    public function getAdmin()
    {
        try {
            $sql = 'SELECT * FROM khach_hang WHERE role=1';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    
}


?>