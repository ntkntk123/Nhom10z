<?php
class CommentController {
    private $authController;

    public function __construct() {
        $this->authController = new CommentModel();
    }

    public function postComment() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // if (!$this->authController->isLoggedIn()) {
            //     $_SESSION['error'] = "Bạn phải đăng nhập để bình luận.";
            //     header("Location: " . BASE_URL . "?act=login");
            //     exit();
            // }

            $commentText = $_POST['noi_dung'];
            $userId = $_SESSION['id_khach_hang'];
            $postId = $_POST['id_san_pham'];
          

            CommentModel::saveComment((int)$userId, $commentText, (int)$postId);

            $_SESSION['success'] = "Bình luận của bạn đã được gửi.";
            header("Location: " . BASE_URL . "?act=chitietsanpham&id_san_pham=" . $postId);
            // exit();
        }
    }
}