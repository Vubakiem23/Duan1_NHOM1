
<?php

// Kế thừa từ BaseModel
require_once 'BaseModel.php';

class Order extends BaseModel
{
    protected $table = 'orders';  // Đặt tên bảng tương ứng

    // Hàm lấy danh sách tất cả đơn hàng
    public function getAll($columns = '*')
    {
        return $this->getOrders($columns);
    }

    /**
     * Hàm lấy danh sách đơn hàng theo điều kiện
     * 
     * @param string $columns Cột cần lấy (mặc định lấy tất cả các cột)
     * @param string $conditions Điều kiện lọc
     * @param array $params Các tham số liên quan đến điều kiện
     * @return array
     */
    public function getOrders($columns = '*', $conditions = null, $params = [])
    {
        return $this->select($columns, $conditions, $params);
    }

    /**
     * Hàm đếm số lượng đơn hàng theo điều kiện
     * 
     * @param string $conditions Điều kiện lọc
     * @param array $params Các tham số liên quan đến điều kiện
     * @return int
     */
    public function countOrders($conditions = null, $params = [])
    {
        return $this->count($conditions, $params);
    }

    /**
     * Hàm lấy đơn hàng theo trang
     * 
     * @param int $page Trang hiện tại
     * @param int $perPage Số bản ghi mỗi trang
     * @param string $columns Cột cần lấy
     * @param string $conditions Điều kiện lọc
     * @param array $params Các tham số liên quan đến điều kiện
     * @return array
     */
    public function paginateOrders($page = 1, $perPage = 5, $columns = '*', $conditions = null, $params = [])
    {
        return $this->paginate($page, $perPage, $columns, $conditions, $params);
    }

    /**
     * Hàm lấy 1 đơn hàng theo điều kiện
     * 
     * @param string $columns Cột cần lấy
     * @param string $conditions Điều kiện lọc
     * @param array $params Các tham số liên quan đến điều kiện
     * @return array
     */
    public function getOrder($columns = '*', $conditions = null, $params = [])
    {
        return $this->find($columns, $conditions, $params);
    }

    /**
     * Hàm tạo đơn hàng mới
     * 
     * @param array $data Dữ liệu đơn hàng
     * @return int ID của đơn hàng vừa tạo
     */
    public function createOrder($data)
    {
        return $this->insert($data);
    }

    /**
     * Hàm cập nhật thông tin đơn hàng
     * 
     * @param array $data Dữ liệu cần cập nhật
     * @param string $conditions Điều kiện để cập nhật
     * @param array $params Các tham số liên quan đến điều kiện
     * @return int Số bản ghi được cập nhật
     */
    public function updateOrder($data, $conditions = null, $params = [])
    {
        return $this->update($data, $conditions, $params);
    }

    /**
     * Hàm xóa đơn hàng
     * 
     * @param string $conditions Điều kiện xóa
     * @param array $params Các tham số liên quan đến điều kiện
     * @return int Số bản ghi bị xóa
     */
    public function deleteOrder($conditions = null, $params = [])
    {
        return $this->delete($conditions, $params);
    }

    /**
     * Hàm lấy danh sách sản phẩm trong đơn hàng
     * 
     * @param int $orderId ID của đơn hàng
     * @return array Danh sách sản phẩm
     */
    public function getOrderProducts($orderId)
    {
        // Giả sử bảng "order_products" là bảng trung gian lưu trữ mối quan hệ giữa đơn hàng và sản phẩm
        $sql = "SELECT * FROM order_products op
                JOIN products p ON op.product_id = p.id
                WHERE op.order_id = :order_id";
        
        return $this->select('*', 'op.order_id = :order_id', ['order_id' => $orderId]);
    }
}
