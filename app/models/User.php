<?php
require_once 'app/config/db.php';

class User
{
    /* Clase User
     * Encapsula la lógica para autenticación (login) y registro de usuarios.
     */
    private $db;

    /**
     * Constructor de la clase.
     * Establece la conexión con la base de datos usando la clase Database.
     */
    public function __construct()
    {
        $this->db = Database::connect();
    }

    /*
     * Método para iniciar sesión.
     * Busca un usuario por correo y cédula en la tabla 'usuario'*/

    public function login($correo, $cedula)
    {
        // Prepara la consulta para evitar inyección SQL
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE Correo = ? AND Cedula = ?");
        // Vincula parámetros: "s" para string, "i" para entero
        $stmt->bind_param("si", $correo, $cedula);
        $stmt->execute();
        // Obtiene el resultado como array asociativo
        $result = $stmt->get_result()->fetch_assoc();

        if ($result) {
            // Si existe el usuario, inicia sesión y guarda datos en variables de sesión
            session_start();
            $_SESSION['usuario'] = $result;
            $_SESSION['rol'] = $result['rol'];
            return true;
        } else {
            return false;
        }
    }

    /*
     * Método para registrar un nuevo usuario en la base de datos.
     * Inserta en la tabla 'usuario' los datos básicos del nuevo registro.*/
    public function register($cedula, $nombre, $apellido, $correo, $provincia, $rol)
    {
        // Prepara la sentencia de inserción
        $stmt = $this->db->prepare("INSERT INTO usuario (Cedula, Nombre, Apellido1, Correo, Provincia, rol) VALUES (?, ?, ?, ?, ?, ?)");
        // Vincula los parámetros a la consulta
        $stmt->bind_param("isssss", $cedula, $nombre, $apellido, $correo, $provincia, $rol);
        return $stmt->execute();
    }
}