<?php
class articuloManager {
    private $db;

    public function __construct() {
        // Obtenemos la conexión a la base de datos
        $this->db = Database::getInstance()->getConnection();
    }

    // Método para obtener la lista de productos
    public function getAllProducts() {
        $stmt = $this->db->query("SELECT * FROM products where inventario>0 ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metodo para obtener datos de un producto en base al id
    public function getProductbyId($id) {
        $stmt = $this->db->prepare("SELECT * FROM products where id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para crear un nuevo producto
    public function createProduct($nombre, $precio, $vendedor, $inventario, $description) {
        $stmt = $this->db->prepare("INSERT INTO products (nombre, precio, vendedor, inventario, description) VALUES (?,?,?,?,?)");
        return $stmt->execute([$nombre, $precio, $vendedor, $inventario, $description]);
    }

    // Método para disminuir el inventario de un producto en 1
    public function disminuirInventario($id) {
        $stmt = $this->db->prepare("UPDATE products SET inventario = (inventario -1) WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Método para eliminar un producto
    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}