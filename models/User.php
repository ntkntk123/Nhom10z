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
            $sql = 'SELECT * FROM nguoi_dung';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM nguoi_dung WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    //đăng kí
    public function postRegister($user, $pass, $email, $pass2)
    {
        try {
            $sql = 'INSERT INTO nguoi_dung (username, password, email)
                VALUES(:username, :password, :email)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':username' => $user, ':email' => $email, ':password' => $pass]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function postAddUser($user, $pass, $email)
    {
        try {
            $sql = 'INSERT INTO nguoi_dung (username, password, email)
                VALUES(:username, :password, :email)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':username' => $user, ':email' => $email, ':password' => $pass]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getUserId($id)
    {
        try {
            $sql = 'SELECT * FROM nguoi_dung WHERE id_nguoi_dung=:id_nguoi_dung';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id_nguoi_dung' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function postUpdateUser($id, $user, $pass, $email, $phone, $role)
    {
        try {
            $sql = 'UPDATE nguoi_dung SET  username=:username, password=:password , email=:email, phone=:phone, role=:role
            WHERE id_nguoi_dung=:id_nguoi_dung';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id_nguoi_dung' => $id, ':username' => $user, ':email' => $email, ':phone' => $phone, ':password' => $pass, ':role' => $role]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function deleteUser($id)
    {
        try {
            $sql = 'DELETE FROM nguoi_dung WHERE id_nguoi_dung=:id_nguoi_dung';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id_nguoi_dung' => $id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

}