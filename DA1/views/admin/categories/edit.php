<h2>Sửa danh mục</h2>
<form method="POST" action="?action=admin/category/update">
    <input type="hidden" name="id" value="<?= $category['id'] ?>">
    <label>Tên danh mục:</label><br>
    <input type="text" name="name" value="<?= $category['name'] ?>" placeholder="Nhập tên danh mục" required><br><br>
    <button type="submit">Cập nhật</button>
</form>
<a href="?action=admin/category">Quay lại</a>