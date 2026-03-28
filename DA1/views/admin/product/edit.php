<h1>Sửa</h1>

<form method="POST" action="?action=admin/product/update">
<input type="hidden" name="id" value="<?= $product['id'] ?>">

<input name="title" value="<?= $product['title'] ?>"><br>
<input name="price" value="<?= $product['price'] ?>"><br>
<input name="image" value="<?= $product['image'] ?>"><br>

<button>Update</button>
</form>