<?php
require_once __DIR__ . '/../core/Database.php';

class Cargo
{

    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Obtener todos los cargos
    public function obtenerCargos(): array
    {
        $sql  = "SELECT id_cargo, nombre_cargo FROM cargo ORDER BY id_cargo ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insertar nuevo cargo
    public function crear(string $nombre): bool
    {
        $sql  = "INSERT INTO cargo (nombre_cargo) VALUES (:nombre)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':nombre' => $nombre]);
    }

    // Actualizar cargo por id
    public function actualizar(int $id, string $nombre): bool
    {
        $sql  = "UPDATE cargo SET nombre_cargo = :nombre WHERE id_cargo = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':nombre' => $nombre, ':id' => $id]);
    }

    // Eliminar cargo por id
    public function eliminar(int $id): bool
    {
        $sql  = "DELETE FROM cargo WHERE id_cargo = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
