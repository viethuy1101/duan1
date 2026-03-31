<form action="<?= BASE_URL ?>admin/category/store" method="POST">
    <div class="mb-3">
        <label>Tên danh mục</label>
        <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục..." required>
    </div>
    <button type="submit" class="btn btn-primary">Lưu danh mục</button>
</form>