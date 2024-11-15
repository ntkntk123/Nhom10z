<?php 

class UserController
{
    public $modelUser;
    public function __construct()
    {
        $this->modelUser = new User();
    }

    public function trangchu(){
        require_once './views/trangchu.php';
    }
    

    public function listUser(){
        $listUser = $this->modelUser->getAllUser();
        require_once './admin/listUser.php';
    }

    public function login() {
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
            } else {
                echo "Tên đăng nhập hoặc mật khẩu không đúng!";
            }
        } else {

            require './login/login.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: views/login.php");
    }

    public function formRegister(){
        require_once './login/logup.php';
    }

    public function formAddUser(){
        require_once './admin/formAddUser.php';
    }


    //đăng kí
    public function register(){
        if (isset($_POST['username'])) {
            $user = $_POST['username'];
            $email = $_POST['email'];
            $pass=$_POST['password'];
            $pass2=$_POST['password2'];
      
            if ($this->modelUser->postRegister($user, $pass, $email, $pass2)) {
                header("Location: ./");
            }
        }
    }

    public function admin(){
        require_once './admin/admin.php';
    }
    
    
    public function postAddUser(){
        if (isset($_POST['username'])) {
            $user = $_POST['username'];
            $email = $_POST['email'];
            $pass=$_POST['password']; 
            if ($this->modelUser->postAddUser($user, $pass, $email)) {
                header("Location: ?act=quan-li-user");
            }
        }
    }


    public function formUpdateUser(){
        $id = $_GET['id_nguoi_dung'];
        $user = $this->modelUser->getUserId($id);
        // var_dump($user);die();
        require_once './admin/formUpdateUser.php';
    }


    public function postUpdateUser(){
        if (isset($_POST['id_nguoi_dung'])) {
            $id = $_POST['id_nguoi_dung'];
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $role = $_POST['role'];
 
            

           
            
            if ($this->modelUser->postUpdateUser($id, $user, $pass,$email, $phone, $role)) {
                header("Location: ./");
            }
        }
    }

    public function deleteUser(){
        $id = $_GET['id_nguoi_dung'];
        if ($this->modelUser->deleteUser($id)) {
            header("Location: ./");
            
        }
    }
}