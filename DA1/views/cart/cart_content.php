<h3>Giỏ hàng</h3>

<table class="table">
  <tr>
    <th>Sản phẩm</th>
    <th>Số lượng</th>
    <th>Giá</th>
  </tr>

  <?php foreach($cart as $item): ?>
  <tr>
    <td><?= $item['title'] ?></td>
    <td><?= $item['quantity'] ?></td>
    <td><?= number_format($item['price']) ?></td>
  </tr>
  <?php endforeach; ?>
</table>