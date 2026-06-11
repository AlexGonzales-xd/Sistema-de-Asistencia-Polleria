<?php
require_once __DIR__ . '/../core/Database.php';
date_default_timezone_set('America/Los_Angeles');

class Asistencia
{
    private PDO $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    // Verifica el estado de asistencia del empleado hoy.
    // Retorna: 'sin_registro', 'sin_salida', 'completo'
    public function estadoHoy(int $id_empleado): array
    {
        $sql  = "SELECT id_asistencia, hora_entrada, hora_salida
                 FROM asistencia
                 WHERE id_empleado = ? AND fecha = CURDATE()
                 LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_empleado]);
        $registro = $stmt->fetch();

        if (!$registro) {
            return ['estado' => 'sin_registro'];
        }

        // Si hora_salida = hora_entrada aún no marcó salida
        if ($registro['hora_salida'] === $registro['hora_entrada']) {
            return ['estado' => 'sin_salida', 'id_asistencia' => $registro['id_asistencia']];
        }

        return ['estado' => 'completo'];
    }

    // Registra la ENTRADA del empleado.
    // Si llega después de las 10:00 AM → tardanza, si no → asistio.
    public function registrarEntrada(int $id_empleado): void
    {
        $horaActual = new DateTime('now');
        $horaLimite = new DateTime('today 10:00');
        $estado     = $horaActual > $horaLimite ? 'tardanza' : 'asistio';

        $sql  = "INSERT INTO asistencia(fecha, hora_entrada, hora_salida, estado, id_empleado)
                 VALUES(CURDATE(), NOW(), NOW(), ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$estado, $id_empleado]);
    }

    // Registra la SALIDA del empleado actualizando hora_salida.
    public function registrarSalida(int $id_asistencia): void
    {
        $sql  = "UPDATE asistencia SET hora_salida = NOW() WHERE id_asistencia = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_asistencia]);
    }

    // Obtiene asistencias de HOY para el dashboard.
    public function obtenerAsistenciasHoy(): array
    {
        return $this->obtenerPorFecha(date('Y-m-d'));
    }

    // Obtiene asistencias de cualquier fecha con nombre y cargo del empleado.
    public function obtenerPorFecha(string $fecha): array
    {
        $sql  = "SELECT 
                    a.id_asistencia,
                    e.nombre,
                    e.apellido,
                    c.nombre_cargo,
                    a.hora_entrada,
                    CASE 
                        WHEN a.hora_salida = a.hora_entrada THEN NULL
                        ELSE a.hora_salida
                    END AS hora_salida,
                    a.estado
                FROM asistencia a
                INNER JOIN empleado e ON a.id_empleado = e.id_empleado
                INNER JOIN cargo c    ON e.id_cargo    = c.id_cargo
                WHERE a.fecha = ?
                ORDER BY a.hora_entrada DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$fecha]);
        return $stmt->fetchAll();
    }
}
