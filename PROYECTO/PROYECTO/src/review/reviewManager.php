<?php
class reviewManager {
    private $db;

    public function __construct() {
        // Obtenemos la conexión a la base de datos
        $this->db = Database::getInstance()->getConnection();
    }

    // Crear una reseña
    public function crearReview($product_id, $user_id, $rating, $comment) {
        $stmt = $this->db->prepare("INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$product_id,$user_id,$rating,$comment]);
    }

    // Obtener todas las reseñas de un producto usando su id
    public function getReviewsByProduct($productId) {
        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE product_id = ? ORDER BY created_at DESC");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener las reseñas de un usuario
    public function getReviewsByUser($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar reseña
    public function deleteReview($id) {
        $stmt = $this->db->prepare("DELETE FROM reviews WHERE id = ?");
        return $stmt->execute([$id]);
    }

     // Método para obtener la lista de reviews de un comprador
    public function getBuyerReviews($buyer) {
        $stmt = $this->db->prepare("SELECT * FROM reviews where user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$buyer]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}