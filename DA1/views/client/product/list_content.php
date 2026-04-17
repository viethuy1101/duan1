<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    /* CSS cho danh sách sản phẩm */
    .row.g-4 {
      display: grid !important;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)) !important;
      gap: 20px !important;
      width: 100% !important;
      padding: 0 !important;
      margin: 0 !important;
    }

    .col-12.col-md-6.col-lg-3 {
      display: block !important;
      width: auto !important;
      max-width: none !important;
      flex: none !important;
      padding: 0 !important;
    }

    .card {
      height: 100% !important;
      display: flex !important;
      flex-direction: column !important;
      border: 1px solid #ddd !important;
      border-radius: 8px !important;
      transition: all 0.3s ease !important;
      overflow: hidden !important;
      padding: 0 !important;
      margin: 0 !important;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
    }

    .card:hover {
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15) !important;
      transform: translateY(-2px) !important;
    }

    .product-image-wrapper {
      width: 100% !important;
      height: 280px !important;
      overflow: hidden !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      background-color: #f5f5f5 !important;
      flex-shrink: 0 !important;
      padding: 0 !important;
      margin: 0 !important;
      position: relative !important;
    }

    .product-image {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
      border-radius: 0 !important;
      display: block !important;
      padding: 0 !important;
      margin: 0 !important;
    }

    .card-body {
      flex-grow: 1 !important;
      display: flex !important;
      flex-direction: column !important;
      padding: 12px 15px !important;
      margin: 0 !important;
      background: white !important;
    }

    .card-body h6 {
      font-weight: 600 !important;
      font-size: 0.95rem !important;
      margin: 0 0 8px 0 !important;
      flex-grow: 1 !important;
      min-height: auto !important;
      line-height: 1.3 !important;
      color: #333 !important;
    }

    .card-body p {
      margin: 0 0 10px 0 !important;
      padding: 0 !important;
      color: #dc3545 !important;
      font-weight: 600 !important;
      font-size: 0.9rem !important;
    }

    .card-body .btn {
      align-self: flex-start !important;
      margin: 0 !important;
      padding: 6px 12px !important;
      font-size: 0.85rem !important;
    }

    h3 {
      margin-bottom: 30px !important;
      color: #333 !important;
      font-weight: 700 !important;
    }
  </style>
</head>
<body>
 <h3>Danh sách sách</h3>

<div class="row g-4">
  <?php if (!empty($products)): ?>
    <?php foreach($products as $item): ?>
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card">
          <div class="product-image-wrapper">
            <img src="<?= BASE_ASSETS_UPLOADS . 'img/' . htmlspecialchars($item['image'] ?? 'no-image-book.png') ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="product-image" onerror="this.src='<?= BASE_ASSETS_UPLOADS . 'img/no-image-book.png' ?>'">
          </div>
          <div class="card-body">
            <h6><?= htmlspecialchars($item['title']) ?></h6>
            <p class="text-danger"><?= number_format($item['price']) ?> đ</p>
            <a href="<?= BASE_URL ?>?action=detail&id=<?= $item['id'] ?>" class="btn btn-primary btn-sm">
              Xem chi tiết 
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-12">
      <p class="text-center">Không có sản phẩm nào.</p>
    </div>
  <?php endif; ?>
</div> 
</body>
</html>