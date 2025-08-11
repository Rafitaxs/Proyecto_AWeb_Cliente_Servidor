<?php
include '../models/CitaModel.php';

class CitaController {
    private $citaModel;

    public function __construct() {
        $this->citaModel = new CitaModel();
    }

    public function consultarPosicion($id) {
        $cita = $this->citaModel->getCitaById($id);
        if ($cita) {
            $posicion = $this->citaModel->getPosicionEnFila($id);
            return $posicion ? "Tu cita: ($id) tiene la posición: $posicion" : "Posición no disponible";
        } else {
            return 'Cita no encontrada';
        }
    }
}

if (isset($_POST['id_cita'])) {
    $controller = new CitaController();
    $posicion = $controller->consultarPosicion($_POST['id_cita']);
    echo $posicion;
    exit;
}