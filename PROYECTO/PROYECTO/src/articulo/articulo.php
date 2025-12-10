<?php
class Articulo {
    public $id;
    public $nombre;
    public $precio;
    public $vendedor;
    public $inventario;
    public $description;
    public $createdAt;
    public $url_foto;

    // Constructor para crear un objeto Task a partir de un array de datos
    public function __construct($data) {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre']?? null;
        $this->precio = $data['precio']?? null;
        $this->vendedor = $data['vendedor']?? null;
        $this->intentario = $data['inventario']?? null;
        $this->descripcion = $data['description']?? null;
        $this->createdAt = $data['created_at']?? null;
        $this->url_foto = $data['url_foto']?? null;
    }

    // Aquí podrían añadirse métodos adicionales relacionados con una tarea individual
}