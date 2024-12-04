<?php include_once "header.php"; ?>
<?php session_start(); ?>
<article>
    <div class="container mt-5">
        <!-- Header -->
        <div class="text-center">
            <h2>Thanh toán</h2>
            <p>Vui lòng kiểm tra thông tin Khách hàng, thông tin Giỏ hàng trước khi Đặt hàng.</p>
        </div>

        <form action="index.php?act=thanhtoan" method="POST">
            <!-- Trường ẩn lưu ID đơn hàng -->
            <?php 
                if(isset($_SESSION['user'])){
                    $username = $_SESSION['user']['username'];
                    $email = $_SESSION['user']['email'];
                    $phone = $_SESSION['user']['phone'];
                }else{
                    $username="";
                    $email="";
                    $phone="";
                }
            
            
            ?>
            <div>

                <!-- Thông tin khách hàng -->
                <div class="col-md-6">
                    <h4>Thông tin khách hàng</h4>
                    <div class="mb-3">
                        <label for="ten_khach_hang" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="ten_khach_hang" name="ten_khach_hang" 
                               value="<?= $username ?>" 
                               placeholder="Họ và tên" required>
                    </div>
                    <div class="mb-3">
                        <label for="dia_chi" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="dia_chi" name="dia_chi" 
                               value="<?=($khachhang['dia_chi']) ?>" 
                               placeholder="Địa chỉ" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Điện thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" 
                               value="<?= $phone ?>" 
                               placeholder="Số điện thoại" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= $email ?>" 
                               placeholder="Email" required>
                    </div>

                    <h4>Hình thức thanh toán</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cash" value="Tiền mặt" required>
                        <label class="form-check-label" for="cash">Tiền mặt</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="bank" value="Chuyển khoản" required>
                        <label class="form-check-label" for="bank">Chuyển khoản</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="Ship COD" required>
                        <label class="form-check-label" for="cod">Ship COD</label>
                    </div>
                    <input type="hidden" name="id_khach_hang" value="<?= ($khach_hang['id_khach_hang']) ?>">
                </div>

            
                <!-- <div class="col-md-6">
                    <h4>Giỏ hàng</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-end">Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderDetails as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['ten_san_pham']) ?></td>
                                    <td class="text-end"><?= number_format($item['gia'], 0, ',', '.') ?>đ</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Tổng thành tiền</strong></td>
                                <td class="text-end">
                                    <strong>
                                        <?= number_format(array_sum(array_column($orderDetails, 'gia')), 0, ',', '.') ?>đ
                                    </strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div> -->
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Đặt hàng</button>
            </div>
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>
