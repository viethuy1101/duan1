<h1>Sửa Sản Phẩm</h1>

<form method="POST" action="?action=admin/product/update">
    <input type="hidden" name="id" value="<?= $product['id'] ?? '' ?>">

    <p>Tên sách: <input type="text" name="title" value="<?= $product['title'] ?? '' ?>"></p>
    <p>Tác giả: <input type="text" name="author" value="<?= $product['author'] ?? '' ?>"></p>
    <p>Giá: <input type="number" name="price" value="<?= $product['price'] ?? '' ?>"></p>
    <p>Ảnh: <input type="text" name="image" value="<?= $product['image'] ?? '' ?>"></p>
    <p>Kho: <input type="number" name="stock" value="<?= $product['stock'] ?? 0 ?>"></p>
    <p>Mô tả: <textarea name="description"><?= $product['description'] ?? '' ?></textarea></p>

    <button type="submit">Cập nhật</button>
</form>