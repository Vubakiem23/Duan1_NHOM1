<?php
if (isset($_SESSION['success'])) {
    $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

    echo "<div class='alert $class'> {$_SESSION['msg']} </div>";

    unset($_SESSION['success']);
    unset($_SESSION['msg']);
}
?>


<form action="<?= BASE_URL_ADMIN . '&action=shoes-update&id=' . $shoe['s_id'] ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $shoe['s_title'] ?>">
    </div>

    <div class="mb-3 mt-3">
        <label for="category_id" class="form-label">Category:</label>

        <select class="form-control" id="category_id" name="category_id">

            <?php foreach ($categoryPluck as $id => $name): ?>
                <option
                    value="<?= $id ?>"
                    <?= $id == $shoe['c_id'] ? 'selected' : null ?>
                > <?= $name ?> </option>
            <?php endforeach; ?>
            
        </select>
    </div>

    <div class="mb-3 mt-3">
        <label for="price" class="form-label">Price:</label>
        <input type="text" class="form-control" id="price" name="price" value="<?= $shoe['s_price'] ?>">
    </div>
    <div class="mb-3 mt-3">
        <label for="description" class="form-label">Description:<label>
            <br>
        <input type="text" class="form-control" id="description" name="description" value="<?= $shoe['s_description'] ?>">
    </div>
    <div class="mb-3">
        <label for="img_cover" class="form-label">Img Cover:</label>
        <input type="file" class="form-control" id="img_cover" name="img_cover">

        <?php if (!empty($shoe['s_img_cover'])): ?>
            <img src="<?= BASE_ASSETS_UPLOADS . $shoe['s_img_cover'] ?>" width="100px">
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>

    <a href="<?= BASE_URL_ADMIN . '&action=shoes-index' ?>" class="btn btn-danger">Quay lại danh sách</a>
</form>
