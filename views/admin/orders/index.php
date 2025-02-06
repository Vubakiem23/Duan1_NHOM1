<div class="table-responsive mt-3">
    <table class="table table-bordered shadow-sm" style="background-color: #ffffff; border-radius: 8px;">
        <thead class="table-light text-center">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Thanh toán</th>
                <th>Ngày tạo</th>
                <th>Ngày cập nhật</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr class="text-center align-middle">
                    <td><?= $order["id"] ?></td>
                    <td><?= $order["user_id"] ?></td>
                    <td><strong><?= number_format($order["total_price"], 0, ',', '.') ?> VND</strong></td>
                    <td>
                        <span class="badge bg-<?= $order["status"] == 'completed' ? 'success' : ($order["status"] == 'pending' ? 'warning' : 'secondary') ?>">
                            <?= ucfirst($order["status"]) ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-<?= $order["payment_status"] == 'paid' ? 'success' : ($order["payment_status"] == 'unpaid' ? 'danger' : 'info') ?>">
                            <?= ucfirst($order["payment_status"]) ?>
                        </span>
                    </td>
                    <td><?= date("d/m/Y H:i:s", strtotime($order["created_at"])) ?></td>
                    <td><?= date("d/m/Y H:i:s", strtotime($order["updated_at"])) ?></td>
                    <td class="d-flex justify-content-center gap-2">
                        <a href="<?= BASE_URL_ADMIN . '&action=orders-show&id=' . $order['id'] ?>" class="btn btn-sm btn-info text-white">Xem</a>
                        <a href="<?= BASE_URL_ADMIN . '&action=orders-edit&id=' . $order['id'] ?>" class="btn btn-sm btn-warning text-white">Sửa</a>
                        <a href="<?= BASE_URL_ADMIN . '&action=orders-delete&id=' . $order['id'] ?>" onclick="return confirm('Có chắc xóa không?')" class="btn btn-sm btn-danger text-white">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
