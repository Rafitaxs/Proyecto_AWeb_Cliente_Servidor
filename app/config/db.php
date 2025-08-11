<?php
class Database
{
    public static function connect()
    {
        $host = 'localhost';
        $usuario = 'root';
        $contrasena = 'Chris##2003##';
        $base_datos = 'clienteservidor';

        $conn = new mysqli($host, $usuario, $contrasena, $base_datos);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        return $conn;
    }
}
?>