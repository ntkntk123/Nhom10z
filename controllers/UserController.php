<?php

class UserController{
    public $modelUser;
    public function __construct(){
        $this->modelUser=new User();
    }

    public function login() {
       $err="";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $user = $this->modelUser->login($username, $password);

            if ($user) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['role'] = $user['role'];
                
                header("Location: ?act=/");
                

                // if($user['role']==1){
                //     header("Location: ?act=form-add-user");
                // }
            } 
            
            else {
                //  echo ("Tên đăng nhập hoặc mật khẩu không đúng!") . "tai khoan:".$username. "mat khau".$password;
                 $err="Tài khoản hoặc mật khẩu không chính xác.";
                 require './login/login.php';
            }
        } else {

                require './login/login.php';
        }
    }
    public function logout(){
        session_start();
        unset($_SESSION['username'] );
        unset( $_SESSION['password']);
        unset( $_SESSION['role']);

        header("Location: ?act=/");
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
}

    

   
?>