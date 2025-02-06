<h2>Chi tiết đơn hàng #<?= $order['id'] ?></h2>

<table class="table">
    <tr>
        <th>TRƯỜNG DỮ LIỆU</th>
        <th>GIÁ TRỊ</th>
    </tr>

    <tr>
        <td><strong>User ID</strong></td>
        <td><?= $order["user_id"] ?></td>
    </tr>
    <tr>
        <td><strong>Tổng tiền</strong></td>
        <td><?= number_format($order["total_price"], 2) ?> VNĐ</td>
    </tr>
    <tr>
        <td><strong>Trạng thái</strong></td>
        <td><?= ucfirst($order["status"]) ?></td>
    </tr>
    <tr>
        <td><strong>Thanh toán</strong></td>
        <td><?= ucfirst($order["payment_status"]) ?></td>
    </tr>
    <tr>
        <td><strong>Ngày tạo</strong></td>
        <td><?= date('d/m/Y H:i:s', strtotime($order["created_at"])) ?></td>
    </tr>
    <tr>
        <td><strong>Ngày cập nhật</strong></td>
        <td><?= date('d/m/Y H:i:s', strtotime($order["updated_at"])) ?></td>
    </tr>

    <tr>
        <td><strong>Sản phẩm trong đơn hàng</strong></td>
        <td>
            <?php if (!empty($order["products"])): ?>
                <ul>
                    <?php foreach ($order["products"] as $product): ?>
                        <li><?= $product["name"] ?> (x<?= $product["quantity"] ?>) - <?= number_format($product["price"], 2) ?> VNĐ</li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Không có sản phẩm nào trong đơn hàng này.</p>
            <?php endif; ?>
        </td>
    </tr>
</table>

<a href="index.php?controller=orders" class="btn btn-secondary">Quay lại danh sách</a>

