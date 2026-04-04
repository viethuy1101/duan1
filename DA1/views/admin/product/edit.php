<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
</head>
<body>
    <div class="container-fluid py-5">
        <div class="card shadow-sm border-0 mx-auto" style="max-width: 900px; border-radius: 15px;">
            <div class="card-header bg-white py-3 border-0 mt-2">
                <h4 class="mb-0 fw-bold text-primary d-flex align-items-center">
                    <i class="bi bi-pencil-square me-2"></i> Chỉnh sửa sản phẩm
                </h4>
            </div>
            
            <div class="card-body p-4">
                <form action="?action=admin/product/update&id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Tên sách</label>
                                    <input type="text" name="title" class="form-control form-control-lg border-2" value="<?= $product['title'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Tác giả</label>
                                    <input type="text" name="author" class="form-control" value="<?= $product['author'] ?>">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Số lượng kho</label>
                                    <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?? 0 ?>">
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Mô tả chi tiết</label>
                                    <textarea name="description" class="form-control" rows="5"><?= $product['description'] ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light border-0 p-3 rounded-4">
                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Giá bán (VNĐ)</label>
                                    <input type="number" name="price" class="form-control form-control-lg text-danger fw-bold border-2" value="<?= $product['price'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Ảnh sản phẩm</label>
                                    <div class="mb-2 border rounded-3 overflow-hidden bg-white" style="height: 200px;">
                                        <img src="assets/uploads/img/<?= $product['image'] ?>" class="w-100 h-100" style="object-fit: contain;" id="previewImg">
                                    </div>
                                    
                                    <input type="file" name="image_upload" class="form-control form-control-sm" onchange="previewFile(this)">
                                    <input type="hidden" name="current_image" value="<?= $product['image'] ?>">
                                    <div class="mt-2 small text-muted">File: <span class="fw-medium"><?= $product['image'] ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-5 pt-3 border-top justify-content-end">
                        <a href="?action=admin/product" class="btn btn-light border-2 px-4 fw-bold">Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm fw-bold">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewFile(input){
            var file = $("input[type=file]").get(0).files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>