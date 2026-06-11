<?php
require_once __DIR__ . '/../core/Database.php';

class Usuario
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Obtiene todos los usuarios
    public function obtenerUsuarios(): array
    {
        $sql  = "SELECT id_usuario, roles, nombre_usuario FROM usuario ORDER BY id_usuario DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Crea un nuevo usuario validando que el nombre no esté repetido
    public function crear(array $datos): array
    {
        $sql  = "SELECT id_usuario FROM usuario WHERE nombre_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$datos['nombre_usuario']]);
        if ($stmt->fetch()) {
            return ['ok' => false, 'mensaje' => 'Ya existe un usuario con ese nombre'];
        }

        $sql  = "INSERT INTO usuario (roles, nombre_usuario, clave) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$datos['roles'], $datos['nombre_usuario'], $datos['clave']]);
        return ['ok' => true, 'mensaje' => 'Usuario creado correctamente'];
    }

    // Elimina un usuario por ID
    public function eliminar(int $id): void
    {
        $sql  = "DELETE FROM usuario WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
    }

    // Edita un usuario (cambia rol y/o clave)
    public function editar(array $datos): array
    {
        // Validar nombre único excluyendo el mismo usuario
        $sql  = "SELECT id_usuario FROM usuario WHERE nombre_usuario = ? AND id_usuario != ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$datos['nombre_usuario'], $datos['id_usuario']]);
        if ($stmt->fetch()) {
            return ['ok' => false, 'mensaje' => 'Ya existe otro usuario con ese nombre'];
        }

        // Si se envía nueva clave la actualizamos, si no mantenemos la actual
        if (!empty($datos['clave'])) {
            $sql  = "UPDATE usuario SET roles=?, nombre_usuario=?, clave=? WHERE id_usuario=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$datos['roles'], $datos['nombre_usuario'], $datos['clave'], $datos['id_usuario']]);
        } else {
            $sql  = "UPDATE usuario SET roles=?, nombre_usuario=? WHERE id_usuario=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$datos['roles'], $datos['nombre_usuario'], $datos['id_usuario']]);
        }

        return ['ok' => true, 'mensaje' => 'Usuario actualizado correctamente'];
    }
}
