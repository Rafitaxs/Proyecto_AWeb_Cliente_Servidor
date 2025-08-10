<?php
include 'app/models/User.php';

/**
 * Controlador de Autenticación
 * 
 * Se encarga de recibir los datos de los formularios de inicio de sesión
 * y registro, llamar a los métodos correspondientes del modelo User
 * y redirigir o responder según el resultado.
 */

class AuthController
{

    /**
     * Maneja el inicio de sesión de un usuario.
     * 
     * - Recibe correo y cédula desde el formulario (POST).
     * - Llama al método login() del modelo User.
     * - Si las credenciales son correctas, redirige a la página de inicio.
     * - Si son incorrectas, muestra una alerta y devuelve al index.
     */
    public function login()
    {
        // Crear una instancia del modelo User
        $user = new User();

        // Obtener datos del formulario
        $correo = $_POST['correo'];
        $cedula = $_POST['cedula'];

        // Intentar iniciar sesión
        if ($user->login($correo, $cedula)) {
            // Login exitoso → redirigir al inicio
            header("Location: pags/inicio.html");
            exit();
        } else {
            // Credenciales incorrectas → mostrar alerta y volver al index
            echo "<script>alert('Credenciales incorrectas'); window.location.href='index.php';</script>";
        }

    }


    /**
     * Maneja el registro de un nuevo usuario.
     * 
     * - Recibe cédula, nombre, apellido, correo, provincia y rol desde el formulario (POST).
     * - Si no se especifica rol, se asigna por defecto "user".
     * - Llama al método register() del modelo User.
     * - Si el registro es exitoso, muestra alerta y vuelve al index.
     * - Si falla, muestra alerta de error.
     */
    public function register()
    {
        // Crear instancia del modelo User
        $user = new User();

        // Obtener datos del formulario
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $provincia = $_POST['provincia'];
        $rol = $_POST['rol'] ?? 'usuario'; // Rol por defecto si no se envía

        // Intentar registrar usuario
        if ($user->register($cedula, $nombre, $apellido, $correo, $provincia, $rol)) {

            // Registro exitoso → mostrar alerta y volver al index
            echo "<script>alert('Registro exitoso'); window.location.href='index.php';</script>";
        } else {
            // Fallo al registrar → mostrar alerta de error
            echo "<script>alert('Error al registrar usuario'); window.location.href='index.php';</script>";
        }
    }




}