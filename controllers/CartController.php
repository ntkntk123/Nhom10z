<?php
class CartController {

    public function __construct() {
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart() {
        
        if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_price'])) {
            $productId = $_POST['product_id'];
            $productName = $_POST['product_name'];
            $productImage = $_POST['product_image'];
            $productPrice = $_POST['product_price'];
            $quantity = 1; // Mặc định số lượng là 1

            // Nếu giỏ hàng chưa có thì khởi tạo mảng giỏ hàng
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = [
                    'id' => $productId,
                    'name' => $productName,
                    'image' => $productImage,
                    'price' => $productPrice,
                    'quantity' => $quantity
                ];
            }

            header('Location: index.php?act=cart');
            exit();
        }
    }

    // Hiển thị giỏ hàng
    public function viewCart() {
        $cart = $_SESSION['cart'] ?? [];
        include 'views/cart.php';
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCart() {
        if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
            $productId = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity'] = $quantity;
            }

            header('Location: index.php?act=cart');
            exit();
        }
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function deleteCart() {
        if (isset($_POST['product_id'])) {
            $productId = $_POST['product_id'];
            unset($_SESSION['cart'][$productId]);
        }

        header('Location: index.php?act=cart');
        exit();
    }
    public function clearCart() {
        // Xóa toàn bộ giỏ hàng
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
    
        // Chuyển hướng về giỏ hàng
        header('Location: index.php?act=cart');
        exit();
    }
    
    // public function cart() {
    //     // Kiểm tra xem người dùng đã đăng nhập chưa
    //     if (isset($_SESSION['user_id'])) {
    //         $userId = $_SESSION['user_id'];
    //         // Lấy giỏ hàng của người dùng
    //         $cart = $this->cartModel->getCartByUser($userId);  // Lấy giỏ hàng từ CartModel
    //         require_once './views/cart.php';  // Thay đổi đường dẫn đến file giỏ hàng đúng
    //     } else {
    //         // Nếu chưa đăng nhập, chuyển đến trang đăng nhập
    //         header("Location: index.php?act=login");
    //     }
    // }
}
?>
