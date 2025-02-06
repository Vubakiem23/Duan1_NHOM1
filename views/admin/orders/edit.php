<!-- orders/edit.php -->
<form method="POST" action="<?= BASE_URL_ADMIN . '&action=orders-update&id=' . $order['id'] ?>">
    <div class="mb-3">
        <label for="status" class="form-label">Trạng thái</label>
        <select name="status" id="status" class="form-select">
            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Đang chờ</option>
            <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
            <option value="canceled" <?= $order['status'] == 'canceled' ? 'selected' : '' ?>>Hủy</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="payment_status" class="form-label">Trạng thái thanh toán</label>
        <select name="payment_status" id="payment_status" class="form-select">
            <option value="paid" <?= $order['payment_status'] == 'paid' ? 'selected' : '' ?>>Đã thanh toán</option>
            <option value="unpaid" <?= $order['payment_status'] == 'unpaid' ? 'selected' : '' ?>>Chưa thanh toán</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
