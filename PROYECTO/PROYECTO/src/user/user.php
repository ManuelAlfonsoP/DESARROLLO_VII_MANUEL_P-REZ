<?php
class User {
    public $id;
    public $username;
    public $password;
    public $full_name;
    public $user_type;

    // Constructor para crear un objeto Task a partir de un array de datos
    public function __construct($data) {
        $this->id = $data['id']?? null;
        $this->username = $data['username']?? null;
        $this->password = $data['password'] ?? null;
        $this->full_name = $data['full_name'] ?? null;
        $this->user_type = $data['user_type']?? null;
    }

    // Aquí podrían añadirse métodos adicionales relacionados con una tarea individual
}