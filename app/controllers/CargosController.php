<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Cargo.php';

// Controlador de la vistas Cargos. --- Solo accesible para usuarios que hayan iniciado sesión.
class CargosController extends Controller
{

    private Cargo $cargo;

    public function __construct()
    {
        $this->cargo = new Cargo();
    }

    // Redirige al index → reporte por defecto
    public function index(): void
    {
        $this->reporte();
    }

    // Vista principal: tabla de cargos
    public function reporte(): void
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $this->soloSuperAdmin();

        $this->view('cargos/reportes', [
            'usuario' => $_SESSION['usuario'],
            'cargos'  => $this->cargo->obtenerCargos(),
        ]);
    }

    // Alias de reporte() — mantiene compatibilidad con rutas existentes
    public function reportes(): void
    {
        $this->reporte();
    }

    // ─── STORE: Guardar nuevo cargo ──────────────────────────
    public function store(): void
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $this->soloSuperAdmin();

        $nombre = trim($_POST['nombre_cargo'] ?? '');

        if ($nombre !== '') {
            $this->cargo->crear($nombre);
        }

        header('Location: ' . BASE_URL . '/cargos/reportes');
        exit;
    }

    // ─── UPDATE: Actualizar cargo existente ──────────────────
    public function update(): void
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $this->soloSuperAdmin();

        $id     = (int)($_POST['id_cargo']    ?? 0);
        $nombre = trim($_POST['nombre_cargo'] ?? '');

        if ($id > 0 && $nombre !== '') {
            $this->cargo->actualizar($id, $nombre);
        }

        header('Location: ' . BASE_URL . '/cargos/reportes');
        exit;
    }

    // ─── DESTROY: Eliminar cargo ─────────────────────────────
    public function destroy(): void
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $this->soloSuperAdmin();

        $id = (int)($_POST['id_cargo'] ?? 0);

        if ($id > 0) {
            $this->cargo->eliminar($id);
        }

        header('Location: ' . BASE_URL . '/cargos/reportes');
        exit;
    }
}
    