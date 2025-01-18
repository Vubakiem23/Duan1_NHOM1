<?php
$action = $_GET['action'] ?? '/';

if (
    empty($_SESSION['user'])
    && !in_array($action, ['show-form-login', 'login'])
) {
    header('Location: ' . BASE_URL_ADMIN . '&action=show-form-login');
    exit();
}

match ($action) {
    '/'         => (new DashboardController)->index(),
    'test-show' => (new TestController)->show(),

    'show-form-login'       => (new AuthenController)->showFormLogin(),
    'login'                 => (new AuthenController)->login(),
    'logout'                => (new AuthenController)->logout(),

    // CRUD User
    'users-index'    => (new UserController)->index(),   // Hiển thị danh sách
    'users-show'     => (new UserController)->show(),    // Hiển thị chi tiết theo ID
    'users-create'   => (new UserController)->create(),  // Hiển thị form thêm mới
    'users-store'    => (new UserController)->store(),   // Lưu dữ liệu thêm mới
    'users-edit'     => (new UserController)->edit(),    // Hiển thị form cập nhật theo ID
    'users-update'   => (new UserController)->update(),  // Lưu dữ liệu cập nhật theo ID
    'users-delete'   => (new UserController)->delete(),  // Xóa dữ liệu theo ID

    // CRUD Shoe
    'shoes-index'    => (new ShoeController)->index(),   // Hiển thị danh sách
    'shoes-show'     => (new ShoeController)->show(),    // Hiển thị chi tiết theo ID
    'shoes-create'   => (new ShoeController)->create(),  // Hiển thị form thêm mới
    'shoes-store'    => (new ShoeController)->store(),   // Lưu dữ liệu thêm mới
    'shoes-edit'     => (new ShoeController)->edit(),    // Hiển thị form cập nhật theo ID
    'shoes-update'   => (new ShoeController)->update(),  // Lưu dữ liệu cập nhật theo ID
    'shoes-delete'   => (new ShoeController)->delete(),  // Xóa dữ liệu theo ID
};
