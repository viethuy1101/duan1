<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Đơn hàng</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Khách hàng</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
        <th>Action</th>
    </tr>

    <?php foreach ($orders as $o): ?>
    <tr>
        <td><?= $o['id'] ?></td>
        <td><?= $o['customer_name'] ?></td>
        <td><?= $o['total'] ?></td>
        <td>
            <?php if ($o['status'] == 0): ?>
                Chờ xử lý
            <?php elseif ($o['status'] == 1): ?>
                Đang giao
            <?php else: ?>
                Hoàn thành
            <?php endif; ?>
        </td>
        <td>
            <a href="/admin/orders/detail?id=<?= $o['id'] ?>" class="btn btn-edit">Xem</a>
            <a href="/admin/orders/update?id=<?= $o['id'] ?>&status=1" class="btn btn-add">Duyệt</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>