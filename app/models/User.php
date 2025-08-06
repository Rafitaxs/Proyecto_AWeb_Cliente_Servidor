<?php
require_once 'app/config/db.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function login($correo, $cedula) {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE Correo = ? AND Cedula = ?");
        $stmt->bind_param("si", $correo, $cedula);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if($result){
            session_start();
            $_SESSION['usuario'] = $result;
            return true;
        } else {
            return false;
        }
    }

    public function register($cedula, $nombre, $apellido, $correo, $provincia, $rol){
        $stmt = $this->db->prepare("INSERT INTO usuario (Cedula, Nombre, Apellido1, Correo, Provincia, rol) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $cedula, $nombre, $apellido, $correo, $provincia, $rol);
        return $stmt->execute();
    }
}