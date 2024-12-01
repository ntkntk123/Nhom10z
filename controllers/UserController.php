<?php

class UserController{
    public $modelUser;
    public function __construct(){
        $this->modelUser=new User();
    }

    public function login() {
        $err = ""; 
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ; 
            $password = $_POST['password'] ;
    
            
            $user = $this->modelUser->login($username, $password);
    
            if ($user) {
                    session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['role'] = $user['role'];
                $_SESSION['id_khach_hang'] = $user['id_khach_hang'];
                $_SESSION['trang_thai'] = $user['trang_thai'];
    
                if ($user['trang_thai'] == 0) {
                    if ($user['role'] == 1){
                        {
                            header("Location: ?act=admin");
                        }
                    }else{

                    header("Location: ?act=/");
                    exit(); 
                }} else {
                    $err = "Tài khoản hoặc mật khẩu không chính xác.";
                }
            } else {
                $err = "Tài khoản hoặc mật khẩu không chính xác.";
            }
        }
        require './login/login.php';
    }
    
    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        unset($_SESSION['username'] );
        unset( $_SESSION['password']);
        unset( $_SESSION['role']);

        header("Location: ?act=/");
    }

    public function formAddUser(){
        require_once './admin/formAddUser.php';
    }
    public function formRegister(){
        require_once './login/register.php';
    }
    public function register(){
        if (isset($_POST['username'])) {
            $user = $_POST['username'];
            $ten_khach_hang=$_POST['ten_khach_hang'];
            $phone=$_POST['phone'];
            $email = $_POST['email'];
            $pass=$_POST['password'];
            $pass2=$_POST['password2'];
      
            if ($this->modelUser->postRegister($ten_khach_hang, $user,  $pass,$phone, $email, $pass2)) {
                header("Location: ./");
            }
        }
    }

    //hiển thị danh sách user để quản lí 
    public function listUser(){
        $listUser = $this->modelUser->getAllUser();
        require_once './admin/quanliuser.php';
    }

    
    public function formUpdateUser(){
        $id = $_GET['id_khach_hang'];
        $user = $this->modelUser->getUserId($id);
        // var_dump($user);die();
        require_once './admin/formUpdateUser.php';
    }

    //sửa 
    public function postUpdateUser(){
        if (isset($_POST['id_khach_hang'])) {
            $id = $_POST['id_khach_hang'];
            $ten_khach_hang=$_POST['ten_khach_hang'];
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $trang_thai=$_POST['trang_thai'];
            $role = $_POST['role'];
 
            

           
            
            if ($this->modelUser->postUpdateUser($id, $ten_khach_hang, $user, $pass,$email, $phone, $trang_thai, $role)) {
                header("Location: ./");
            }
        }
    }

    public function deleteUser(){
        $id = $_GET['id_khach_hang'];
        if ($this->modelUser->deleteUser($id)) {
            header("Location: ./");
            
        }
    }
    

    public function admin(){
        $listUser = $this->modelUser->getAllUser();
        require_once './admin/admin.php';
        
       
    
}
}
?>