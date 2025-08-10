<?php
include 'app/models/User.php';

class AuthController
{

    public function login()
    {
        $user = new User();
        $correo = $_POST['correo'];
        $cedula = $_POST['cedula'];

        if ($user->login($correo, $cedula)) {
            header("Location: pags/inicio.html");
            exit();
        } else {
            echo "<script>alert('Credenciales incorrectas'); window.location.href='index.php';</script>";
        }

    }

    public function register()
    {
        $user = new User();
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $provincia = $_POST['provincia'];
        $rol = $_POST['rol'] ?? 'user';

        if ($user->register($cedula, $nombre, $apellido, $correo, $provincia, $rol)) {
            echo "<script>alert('Registro exitoso'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error al registrar usuario'); window.location.href='index.php';</script>";
        }
    }




}