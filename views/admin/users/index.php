<a href="<?= BASE_URL_ADMIN . '&action=users-create' ?>" class="btn btn-primary mb-4">
    <i class="fas fa-user-plus"></i> Thêm mới
</a>

<?php
if (isset($_SESSION['success'])) {
    $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';
    echo "<div class='alert $class alert-dismissible fade show' role='alert'>
            {$_SESSION['msg']}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    unset($_SESSION['success']);
    unset($_SESSION['msg']);
}
?>

<div class="table-responsive">
    <table class="table table-hover table-bordered align-middle">
        <thead class="table-primary text-center">
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $user): ?>
                <tr>
                    <td class="text-center"><?= $user['id'] ?></td>
                    <td class="text-center">
                        <?php if (!empty($user['avatar'])): ?>
                            <img src="<?= BASE_ASSETS_UPLOADS . $user['avatar'] ?>" width="80" height="80" class="rounded-circle">
                        <?php else: ?>
                            <span class="text-muted">No avatar</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td class="text-center">
                        <a href="<?= BASE_URL_ADMIN . '&action=users-show&id=' . $user['id'] ?>" 
                           class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Xem
                        </a>
                        <a href="<?= BASE_URL_ADMIN . '&action=users-edit&id=' . $user['id'] ?>" 
                           class="btn btn-warning btn-sm mx-2">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <a href="<?= BASE_URL_ADMIN . '&action=users-delete&id=' . $user['id'] ?>" 
                           onclick="return confirm('Có chắc xóa không?')"
                           class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

