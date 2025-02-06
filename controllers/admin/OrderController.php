
<?php
require_once __DIR__ . "/../../models/Order.php";

class OrderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new Order();
    }

    // Hiển thị danh sách tất cả đơn hàng
    public function index() {
        $view = 'orders/index';
        $title = 'Danh sách Đơn Hàng';
        
        // Get all orders from the model
        $orders = $this->orderModel->getAll();  // Ensure this returns an array of orders
        
        // Check if orders exist
        if ($orders === null) {
            $orders = [];  // Initialize to an empty array if null to avoid errors in the view
        }
    
        require_once PATH_VIEW_ADMIN_MAIN;
    }
    

    // Hiển thị chi tiết đơn hàng theo ID
    public function show() {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }
    
            $id = $_GET['id'];
            $order = $this->orderModel->getOrder('*', 'id = :id', ['id' => $id]);  // Fetch the order by ID
    
            if (empty($order)) {
                throw new Exception("Đơn hàng có ID = $id KHÔNG TỒN TẠI!");
            }
    
            // Fetch the products related to the order
            $order['products'] = $this->orderModel->getOrderProducts($id);  // Make sure this method is implemented in the Order model
    
            // Set view and title
            $view = 'orders/show';
            $title = "Chi tiết Đơn Hàng có ID = $id";
    
            // Include the main view template
            require_once PATH_VIEW_ADMIN_MAIN;
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
            
            // Redirect back to orders list
            header('Location: ' . BASE_URL_ADMIN . '&action=orders-index');
            exit();
        }
    }
    

    // Thay đổi trạng thái đơn hàng
    public function updateStatus() {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Yêu cầu phương thức phải là POST');
            }

            if (!isset($_GET['id']) || !isset($_POST['status'])) {
                throw new Exception('Thiếu tham số!');
            }

            $id = $_GET['id'];
            $status = $_POST['status'];
            
            $rowCount = $this->orderModel->update(['status' => $status], 'id = :id', ['id' => $id]);

            if ($rowCount > 0) {
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Cập nhật trạng thái đơn hàng thành công!';
            } else {
                throw new Exception('Cập nhật trạng thái thất bại!');
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
        }
        
        header('Location: ' . BASE_URL_ADMIN . '&action=orders-index');
        exit();
    }

    // Thay đổi trạng thái thanh toán
    public function updatePaymentStatus() {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Yêu cầu phương thức phải là POST');
            }

            if (!isset($_GET['id']) || !isset($_POST['payment_status'])) {
                throw new Exception('Thiếu tham số!');
            }

            $id = $_GET['id'];
            $payment_status = $_POST['payment_status'];
            
            $rowCount = $this->orderModel->update(['payment_status' => $payment_status], 'id = :id', ['id' => $id]);

            if ($rowCount > 0) {
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Cập nhật trạng thái thanh toán thành công!';
            } else {
                throw new Exception('Cập nhật trạng thái thanh toán thất bại!');
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
        }
        
        header('Location: ' . BASE_URL_ADMIN . '&action=orders-index');
        exit();
    }
}
