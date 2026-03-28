<?php
// views/admin/categories/index.php
// Hiển thị danh sách danh mục
?>
<h1>Danh sách danh mục</h1>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
    </tr>
    <?php if (!empty($categories)) foreach ($categories as $c): ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= $c['name'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>