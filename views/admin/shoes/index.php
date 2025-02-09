<a href="<?= BASE_URL_ADMIN . '&action=shoes-create' ?>" class="btn btn-lg btn-primary mb-4">Thêm mới</a>

<?php
if (isset($_SESSION['success'])) {
    $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

    echo "<div class='alert $class alert-dismissible fade show' role='alert'> {$_SESSION['msg']} 
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";

    unset($_SESSION['success']);
    unset($_SESSION['msg']);
}
?>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>IMG COVER</th>
                <th>TITLE</th>
                <th>PRICE</th>
                <th>CATEGORY NAME</th>
                <th>DESCRIPTION</th>
                <th>CREATED AT</th>
                <th>UPDATED AT</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $shoe): ?>
                <tr>
                    <td><?= $shoe['s_id'] ?></td>
                    <td>
                        <?php if (!empty($shoe['s_img_cover'])): ?>
                            <img src="<?= BASE_ASSETS_UPLOADS . $shoe['s_img_cover'] ?>" width="100px" alt="Shoe Image">
                        <?php endif; ?>
                    </td>
                    <td><?= $shoe['s_title'] ?></td>
                    <td><?= number_format($shoe['s_price'], 0, ',', '.') ?> VND</td>
                    <td><?= $shoe['c_name'] ?></td>
                    <td><?= $shoe['s_description']?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($shoe['s_created_at'])) ?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($shoe['s_updated_at'])) ?></td>
                    <td class="d-flex justify-content-start">
                        <a href="<?= BASE_URL_ADMIN . '&action=shoes-show&id=' . $shoe['s_id'] ?>" class="btn btn-sm btn-info me-2">Xem</a>
                        <a href="<?= BASE_URL_ADMIN . '&action=shoes-edit&id=' . $shoe['s_id'] ?>" class="btn btn-sm btn-warning me-2">Sửa</a>
                        <a href="<?= BASE_URL_ADMIN . '&action=shoes-delete&id=' . $shoe['s_id'] ?>" onclick="return confirm('Có chắc xóa không?')" class="btn btn-sm btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

