<?php
include '../config/db.php';

class CitaModel {
    private $db;
    public function __construct() {
        $this->db = Database::connect();
    }

    public function getCitaById($id) {
        $stmt = $this->db->prepare("SELECT * FROM citas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ?: null;
    }

    // Calcula la posición en la fila por fecha de inscripción y sede
    public function getPosicionEnFila($id) {
        $cita = $this->getCitaById($id);
        if (!$cita) return null;

        $stmt = $this->db->prepare(
            "SELECT COUNT(*) AS posicion FROM citas 
             WHERE sede = ? AND fecha_inscripcion <= ? AND id <= ?"
        );
        $stmt->bind_param("ssi", $cita['sede'], $cita['fecha_inscripcion'], $id);
        $stmt->execute();
        $posicion = $stmt->get_result()->fetch_assoc();
        return $posicion ? $posicion['posicion'] : null;
    }
}