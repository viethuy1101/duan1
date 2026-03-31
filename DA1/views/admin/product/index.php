<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Danh sách sản phẩm</h1>

<a href="<?= BASE_URL ?>admin/product/create" class="btn btn-add">+ Thêm</a>

<table>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Action</th>
    </tr>

    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['title'] ?></td>
        <td><?= $p['price'] ?></td>
        <td>
            <a href="<?= BASE_URL ?>admin/product/edit?id=<?= $p['id'] ?>" class="btn btn-edit">Sửa</a>
<?php foreach ($products as $product): ?>
<tr>
    <td><?= $product['id'] ?></td>
    <td><?= $product['title'] ?></td>
    <td>
        <a href="?action=admin/product/edit&id=<?= $product['id'] ?>" class="btn btn-warning">Sửa</a>

        <a href="?action=admin/product/delete&id=<?= $product['id'] ?>" 
           class="btn btn-danger" 
           onclick="return confirm('M có chắc chắn muốn xóa không?')">Xóa</a>
    </td>
</tr>
<?php endforeach; ?>        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>