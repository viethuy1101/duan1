<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Danh sách danh mục</h1>
<a href="?action=admin/category/create">+ Thêm danh mục</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Thao tác</th>
    </tr>
    <?php if (!empty($categories)) foreach ($categories as $c): ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= $c['name'] ?></td>
        <td>
            <a href="?action=admin/category/edit?id=<?= $c['id'] ?>">Sửa</a> |
            <a href="?action=admin/category/delete?id=<?= $c['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
