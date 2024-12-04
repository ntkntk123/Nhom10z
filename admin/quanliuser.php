<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí user</title>
    <link rel="stylesheet" href="./css/quanli.css">
    <link rel="stylesheet" href="../css/quanli.css">
</head>
<body>
    <h1>Quản lí user</h1>
    <a href="./?act=form-add-user"><button>Thêm user</button></a>
    <table border="1">
        <thead>
            <th>ID</th>
            <th>Tên Khách hàng</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Phone</th>
            <!-- <th>Trạng thái</th> -->
            <th>Quyền Admin</th>
            <th>Thao tác</th>
        </thead>
        <tbody>
            <?php foreach($listUser as $key=>$user): ?>
                <tr>
                    <td><?php echo $user['id_khach_hang']; ?></td>
                    <td><?php echo $user['ten_khach_hang']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['password']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['phone']; ?></td>
                    <!-- <td><?php if($user['trang_thai']==1){
                        echo" Ẩn";
                    }else{
                        echo "Hiện";
                    }
                    
                    ?></td> -->
                    <td><?php if($user['role']==1){
                        echo" Có";
                    }else{
                        echo "Không";
                    }
                    
                    ?></td>

                    <td>
                        <a href="./?act=formUpdateUser&id_khach_hang=<?php echo $user['id_khach_hang']; ?>">
                            <button>Sửa</button>
                        </a>
                        <a href="./?act=deleteUser&id_khach_hang=<?php echo $user['id_khach_hang']; ?>">
                            <button onclick="confirm('Bạn có muốn xóa')">Xóa</button>
                            </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>