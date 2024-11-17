<?php
class User{
    public $conn;
    
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllUser()
    {
        try {
            $sql = 'SELECT * FROM khach_hang';
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

    public function postRegister($ten_khach_hang, $user,  $pass, $email, $pass2)
    {
        try {
            $sql = 'INSERT INTO khach_hang ( ten_khach_hang, username,  password, email)
                VALUES(:ten_khach_hang, :username, :password, :email)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':ten_khach_hang'=>$ten_khach_hang, ':username' => $user,  ':email' => $email, ':password' => $pass]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
?>