<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/quanli.css">
    <link rel="stylesheet" href="../css/quanli.css">
</head>
<body>
    <h1>Quản lí Danh Mục</h1>
    <a href="./?act=form-add-danh-muc"><button>Thêm Danh Mục</button></a>
    <table border="1">
        <thead>
            <th>ID Danh Mục</th>
            <th>Tên Danh Mục</th>
           
            <th>Thao tác</th>
        </thead>
        <tbody>
            <?php foreach($listDanhMuc as $key=>$danhMuc): ?>
                <tr>
                    <td><?php echo $danhMuc['id_danh_muc']; ?></td>
                    <td><?php echo $danhMuc['ten_danh_muc']; ?></td>               
                    <td>
                        <a href="./?act=form-update-danh-muc&id_danh_muc=<?php echo $danhMuc['id_danh_muc']; ?>">
                            <button>Sửa</button>
                        </a>
                        <a href="./?act=delete-danh-muc&id_danh_muc=<?php echo $danhMuc['id_danh_muc']; ?>">
                            <button onclick="confirm('Bạn có muốn xóa danh mục: <?php  echo $danhMuc['id_danh_muc'] ?> hay không?')">Xóa</button>
                            </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>