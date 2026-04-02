<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">Danh Mục Sách</h3>
        <a href="?action=admin/category/create" class="btn btn-success px-4 shadow-sm">
            <i class="bi bi-tag-fill me-2"></i>Thêm Danh Mục
        </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4 py-3 border-0" width="150px">Mã số</th>
                                <th class="py-3 border-0">Tên loại sách</th>
                                <th class="pe-4 py-3 border-0 text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $cat): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-primary">CAT-<?= $cat['id'] ?></td>
                                <td class="fw-semibold text-dark"><?= $cat['name'] ?></td>
                                <td class="pe-4 text-end">
                                    <a href="?action=admin/category/edit&id=<?= $cat['id'] ?>" class="btn btn-sm btn-light border mx-1 shadow-sm">
                                        <i class="bi bi-pencil me-1"></i> Sửa
                                    </a>
                                    <a href="?action=admin/category/delete&id=<?= $cat['id'] ?>" 
                                       class="btn btn-sm btn-danger-subtle text-danger border-0 mx-1 shadow-sm"
                                       onclick="return confirm('Xóa mục này coi chừng mất hết sách bên trong đó!')">
                                       <i class="bi bi-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>