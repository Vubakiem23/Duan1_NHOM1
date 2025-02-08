<?php

class ShoeController
{
    private $shoe;
    private $category;

    public function __construct()
    {
        $this->shoe = new Shoe();
        $this->category = new Category();
    }

    // Hiển thị danh sách
    public function index()
    {
        $view = 'shoes/index';
        $title = 'Danh sách Shoe';
        $data = $this->shoe->getAll();
        
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    // Hiển thị chi tiết theo ID
    public function show()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }

            $id = $_GET['id'];

            $shoe = $this->shoe->getByID($id);

            if (empty($shoe)) {
                throw new Exception("Shoe có ID = $id KHÔNG TỒN TẠI!");
            }

            $view = 'shoes/show';
            $title = "Chi tiết Shoe có ID = $id";

            require_once PATH_VIEW_ADMIN_MAIN;
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL_ADMIN . '&action=shoes-index');
            exit();
        }
    }

    // Hiển thị form thêm mới
    public function create()
    {
        $view = 'shoes/create';
        $title = 'Thêm mới Shoe';

        $categories = $this->category->select();
        $categoryPluck = array_column($categories, 'name', 'id');

        require_once PATH_VIEW_ADMIN_MAIN;
    }

    // Lưu dữ liệu thêm mới
    public function store()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Yêu cầu phương thức phải là POST');
            }

            $data = $_POST + $_FILES;

            if ($data['img_cover']['size'] > 0) {
                $data['img_cover'] = upload_file('shoes', $data['img_cover']);
            } else {
                $data['img_cover'] = null;
            }
            
            $rowCount = $this->shoe->insert($data);

            if ($rowCount > 0) {
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao tác thành công!';
            } else {
                throw new Exception('Thao tác KHÔNG thành công!');
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
        }

        header('Location: ' . BASE_URL_ADMIN . '&action=shoes-create');
        exit();
    }

    // Hiển thị form cập nhật theo ID
    public function edit()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }

            $id = $_GET['id'];

            $shoe = $this->shoe->getByID($id);

            if (empty($shoe)) {
                throw new Exception("Shoe có ID = $id KHÔNG TỒN TẠI!");
            }

            $view = 'shoes/edit';
            $title = "Cập nhật Shoe có ID = $id";

            $categories = $this->category->select();
            $categoryPluck = array_column($categories, 'name', 'id');

            require_once PATH_VIEW_ADMIN_MAIN;
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL_ADMIN . '&action=shoes-index');
            exit();
        }
    }

    // Lưu dữ liệu cập nhật theo ID
    public function update()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Yêu cầu phương thức phải là POST');
            }

            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }

            $id = $_GET['id'];

            $shoe = $this->shoe->find('*', 'id = :id', ['id' => $id]);

            if (empty($shoe)) {
                throw new Exception("Shoe có ID = $id KHÔNG TỒN TẠI!");
            }

            $data = $_POST + $_FILES;

            if ($data['img_cover']['size'] > 0) {
                $data['img_cover'] = upload_file('shoes', $data['img_cover']);
            } else {
                $data['img_cover'] = $shoe['img_cover'];
            }

            $data['updated_at'] = date('Y-m-d H:i:s');

            $rowCount = $this->shoe->update($data, 'id = :id', ['id' => $id]);

            if ($rowCount > 0) {

                if (
                    $_FILES['img_cover']['size'] > 0
                    && !empty($shoe['img_cover'])
                    && file_exists(PATH_ASSETS_UPLOADS . $shoe['img_cover'])
                ) {
                    unlink(PATH_ASSETS_UPLOADS . $shoe['img_cover']);
                }

                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao tác thành công!';
            } else {
                throw new Exception('Thao tác KHÔNG thành công!');
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage() . ' - Line: ' . $th->getLine();

            if ($th->getCode() == 99) {
                header('Location: ' . BASE_URL_ADMIN . '&action=shoes-index');
                exit();
            }
        }

        header('Location: ' . BASE_URL_ADMIN . '&action=shoes-edit&id=' . $id);
        exit();
    }

    // Xóa dữ liệu theo ID
    public function delete()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }

            $id = $_GET['id'];

            $shoe = $this->shoe->find('*', 'id = :id', ['id' => $id]);

            if (empty($shoe)) {
                throw new Exception("Shoe có ID = $id KHÔNG TỒN TẠI!");
            }

            $rowCount = $this->shoe->delete('id = :id', ['id' => $id]);

            if ($rowCount > 0) {

                if (!empty($shoe['img_cover']) && file_exists(PATH_ASSETS_UPLOADS . $shoe['img_cover'])) {
                    unlink(PATH_ASSETS_UPLOADS . $shoe['img_cover']);
                }

                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao tác thành công!';
            } else {
                throw new Exception('Thao tác KHÔNG thành công!');
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
        }

        header('Location: ' . BASE_URL_ADMIN . '&action=shoes-index');
        exit();
    }
}

