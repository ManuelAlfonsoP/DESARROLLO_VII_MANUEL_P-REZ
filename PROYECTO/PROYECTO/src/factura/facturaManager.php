<?php
class facturaManager {
    private $db;

    public function __construct() {
        // Obtenemos la conexión a la base de datos
        $this->db = Database::getInstance()->getConnection();
    }

    // Método para obtener la lista de facturas
    public function getAllReceipts() {
        $stmt = $this->db->query("SELECT * FROM receipts ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metodo para obtener datos de una factura en base al id
    public function getReceiptbyId($id) {
        $stmt = $this->db->prepare("SELECT * FROM receipts where id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para crear una nueva factura
    public function createReceipt($product_id, $product_name, $buyer, $seller) {
        //Disminuir stock del producto
        require_once BASE_PATH . '../articulo/articuloManager.php';
        $articuloManager = new articuloManager();
        $articuloManager->disminuirInventario($product_id);
        $stmt = $this->db->prepare("INSERT INTO receipts (product_id, product_name, buyer, seller) VALUES (?,?,?,?)");
        return $stmt->execute([$product_id, $product_name, $buyer, $seller]);
    }

    // Método para eliminar una factura
    public function deleteReceipt($id) {
        $stmt = $this->db->prepare("DELETE FROM receipts WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getBuyerReceipts($buyerId) {
    $sql = "SELECT r.*, p.nombre AS product_name, p.precio AS product_price, u.full_name AS seller_name FROM receipts r
            INNER JOIN products p ON p.id = r.product_id INNER JOIN users u ON u.id = r.seller WHERE r.buyer = ? ORDER BY r.created_at DESC";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$buyerId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getSellerReceipts($sellerId) {
        $stmt = $this->db->prepare(" SELECT r.*, p.nombre AS product_name, p.precio AS product_price, u.full_name AS buyer_name FROM receipts r JOIN products p ON r.product_id = p.id
            JOIN users u ON r.buyer = u.id WHERE r.seller = ? ORDER BY r.created_at DESC ");
        $stmt->execute([$sellerId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}