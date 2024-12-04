<?php
// Khởi tạo session
// session_start();

// Kiểm tra nếu người dùng đã đăng nhập (kiểm tra session user_id)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "duan";
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn cơ sở dữ liệu lấy thông tin đơn hàng của người dùng
$sql = "SELECT id_don_hang, id_khach_hang, ngay_dat_hang, tong_gia, trang_thai, dia_chi_nhan_hang 
        FROM don_hang WHERE id_khach_hang = ? ORDER BY ngay_dat_hang DESC"; // Lấy đơn hàng của khách hàng, sắp xếp theo ngày đặt hàng
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);  // Lấy thông tin đơn hàng của người dùng hiện tại từ session
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Một số style cơ bản cho trang */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .order-table {
            margin-top: 30px;
        }
        .badge {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Trang Web</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Chào mừng, <?php echo $_SESSION['username']; ?>!</span>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Nội dung lịch sử đơn hàng -->
    <div class="container">
        <h2>Lịch Sử Đơn Hàng</h2>
        
        <!-- Bảng hiển thị lịch sử đơn hàng -->
        <table class="table table-bordered order-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Đơn Hàng</th>
                    <th>Ngày Đặt Hàng</th>
                    <th>Tổng Giá</th>
                    <th>Trạng Thái</th>
                    <th>Địa Chỉ Nhận Hàng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $stt = 1;
                    while ($row = $result->fetch_assoc()) {
                        // Chuyển đổi trạng thái đơn hàng sang văn bản
                        switch ($row['trang_thai']) {
                            case 0:
                                $trang_thai = "Đang chuẩn bị hàng";
                                break;
                            case 1:
                                $trang_thai = "Đang giao";
                                break;
                            case 2:
                                $trang_thai = "Đã giao thành công";
                                break;
                            default:
                                $trang_thai = "Không xác định";
                                break;
                        }

                        // Hiển thị các đơn hàng
                        echo "<tr>";
                        echo "<td>" . $stt . "</td>";
                        echo "<td>" . $row['id_don_hang'] . "</td>";
                        echo "<td>" . $row['ngay_dat_hang'] . "</td>";
                        echo "<td>" . number_format($row['tong_gia'], 0, ',', '.') . " VNĐ</td>";
                        echo "<td><span class='badge bg-" . ($row['trang_thai'] == 0 ? 'info' : ($row['trang_thai'] == 1 ? 'warning' : 'success')) . "'>" . $trang_thai . "</span></td>";
                        echo "<td>" . $row['dia_chi_nhan_hang'] . "</td>";
                        echo "</tr>";
                        $stt++;
                    }
                } else {
                    // Nếu không có đơn hàng nào
                    echo "<tr><td colspan='6' class='text-center'>Không có đơn hàng nào.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-4 mt-5">
        <p>&copy; 2024 Công Ty ABC. Tất cả các quyền được bảo vệ.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Đóng kết nối CSDL
$conn->close();
?>
