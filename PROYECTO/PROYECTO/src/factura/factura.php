<?php
class factura {
    public $id;
    public $product_id;
    public $product_name;
    public $buyer;
    public $seller;
    public $createdAt;

    // Constructor para crear un objeto Task a partir de un array de datos
    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->product_id = $data['product_id'] ?? null;
        $this ->product_name = $data['product_name'] ?? null;
        $this->buyer = $data['buyer'] ?? null;
        $this->seller = $data['seller'] ?? null;
        $this->createdAt = $data['createdAt'] ?? null;
    }

    // Aquí podrían añadirse métodos adicionales relacionados con una tarea individual
}