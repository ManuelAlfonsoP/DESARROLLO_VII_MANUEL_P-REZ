<?php
class disputaManager {
    private $db;

    public function __construct() {
        // Obtenemos la conexión a la base de datos
        $this->db = Database::getInstance()->getConnection();
    }

    // Crear una nueva disputa
    public function createDispute($receipt_id, $user_id, $reason) {
        $stmt = $this->db->prepare("INSERT INTO disputes (receipt_id, user_id, reason) VALUES (?, ?, ?)");
        return $stmt->execute([$receipt_id, $user_id, $reason]);
    }

    // Método para obtener la lista de disputas
    public function getAllDisputes() {
        $sql = " SELECT d.*, r.product_id, p.nombre AS product_name, p.precio AS product_price, r.buyer, r.seller, ub.full_name   AS buyer_name,
                us.full_name AS seller_name FROM disputes d JOIN receipts r ON d.receipt_id = r.id JOIN products p ON r.product_id = p.id JOIN users ub ON r.buyer = ub.id
            JOIN users us ON r.seller = us.id ORDER BY d.created_at DESC ";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una disputa por id
    public function getDisputaById($id) {
        $stmt = $this->db->prepare("SELECT * FROM disputes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Listar todas las disputas por id del usuario
    public function getDisputasByUser($userId){
        $sql = "SELECT d.id, d.receipt_id, d.user_id, d.reason,d.status, d.created_at, r.product_id, r.product_name, r.buyer, r.seller, p.precio AS product_price, u_seller.full_name AS 
        seller_name,u_buyer.full_name AS buyer_name FROM disputes d INNER JOIN receipts r ON r.id = d.receipt_id INNER JOIN products p ON p.id = r.product_id
        INNER JOIN users u_seller ON u_seller.id = r.seller INNER JOIN users u_buyer ON u_buyer.id = r.buyer WHERE d.user_id = :user_id ORDER BY d.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSellerDisputes($sellerId) {
        $sql = "SELECT d.*, r.id AS receipt_id,p.nombre AS product_name, p.precio AS product_price, ub.full_name AS buyer_name, us.full_name AS seller_name FROM disputes d
            JOIN receipts r ON d.receipt_id = r.id JOIN products p ON r.product_id = p.id JOIN users ub ON r.buyer  = ub.id JOIN users us ON r.seller = us.id
            WHERE r.seller = ? ORDER BY d.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$sellerId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualizar estado de la disputa
    public function actualizarEstado($id, $nuevoEstado) {
        $stmt = $this->db->prepare("UPDATE disputes SET status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        return $stmt->execute([$nuevoEstado,$id]);
    }

    // Eliminar disputa
    public function deleteDispute($id) {
        $stmt = $this->db->prepare("DELETE FROM disputes WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getDisputeByIdcomplete($disputeId) {
        $sql = "SELECT d.*, r.id AS receipt_id, p.nombre AS product_name, p.precio AS product_price, ub.full_name AS buyer_name, us.full_name AS seller_name
            FROM disputes d JOIN receipts r ON d.receipt_id = r.id JOIN products p ON r.product_id = p.id JOIN users ub   ON r.buyer  = ub.id
            JOIN users us   ON r.seller = us.id WHERE d.id = ? LIMIT 1 ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$disputeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatus($disputeId, $status) {
        $sql = "UPDATE disputes SET status = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$status, $disputeId]);
    }

}