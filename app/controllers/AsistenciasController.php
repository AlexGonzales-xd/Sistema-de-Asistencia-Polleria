<?php
require_once __DIR__ . '/../core/Controller.php';

class AsistenciasController extends Controller
{

    // Página pública: los empleados marcan asistencia sin login.
    public function index(): void
    {
        $this->view('asistencias/index');
    }

    // Busca empleado por DNI y devuelve JSON.
    public function buscar(): void
    {
        require_once __DIR__ . '/../models/Empleado.php';
        $dni_variable = $_POST['dni'];
        $empleado     = new Empleado();
        $resultado    = $empleado->buscarPorDni($dni_variable);
        header('Content-Type: application/json');
        if ($resultado) {
            echo json_encode(['encontrado' => true, 'empleado' => $resultado]);
        } else {
            echo json_encode(['encontrado' => false]);
        }
    }

    // Registra entrada o salida según el estado del empleado hoy.
    public function registradito(): void
    {
        require_once __DIR__ . '/../models/Asistencia.php';
        $idEmpleado = (int) $_POST['id_empleadito'];
        $asistencia = new Asistencia();

        $estadoHoy = $asistencia->estadoHoy($idEmpleado);

        header('Content-Type: application/json');

        if ($estadoHoy['estado'] === 'sin_registro') {
            $asistencia->registrarEntrada($idEmpleado);
            echo json_encode([
                'registrado' => true,
                'accion'     => 'entrada',
                'mensaje'    => 'Entrada registrada correctamente'
            ]);
        } elseif ($estadoHoy['estado'] === 'sin_salida') {
            $asistencia->registrarSalida($estadoHoy['id_asistencia']);
            echo json_encode([
                'registrado' => true,
                'accion'     => 'salida',
                'mensaje'    => 'Salida registrada correctamente'
            ]);
        } else {
            echo json_encode([
                'registrado' => false,
                'accion'     => 'completo',
                'mensaje'    => 'Ya completaste tu asistencia hoy'
            ]);
        }
    }

    // Reporte de asistencias con filtro por fecha.
    public function reporte(): void
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        require_once __DIR__ . '/../models/Asistencia.php';

        $fecha       = isset($_GET['fecha']) && $_GET['fecha'] !== ''
            ? $_GET['fecha']
            : date('Y-m-d');

        $asistencia  = new Asistencia();
        $asistencias = $asistencia->obtenerPorFecha($fecha);

        $this->view('asistencias/reportes', [
            'usuario'     => $_SESSION['usuario'],
            'asistencias' => $asistencias,
            'fecha'       => $fecha,
        ]);
    }

    // Alias para /asistencias/reportes
    public function reportes(): void
    {
        $this->reporte();
    }

    // Ejemplo hoja: muestra asistencias de hoy
    public function ejemplo_hoja(): void
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        require_once __DIR__ . '/../models/Asistencia.php';

        $asistencia    = new Asistencia();
        $asistenciasHoy = $asistencia->obtenerAsistenciasHoy();

        $this->view('asistencias/ejemplo_hoja', [
            'usuario'        => $_SESSION['usuario'],
            'asistenciasHoy' => $asistenciasHoy,
        ]);
    }
}
