<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuariosController extends Controller
{

    public function index(): void
    {
        $this->reporte();
    }

    public function reporte(): void
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $this->soloSuperAdmin();

        $usuario  = new Usuario();
        $usuarios = $usuario->obtenerUsuarios();

        $this->view('usuarios/reportes', [
            'usuario'  => $_SESSION['usuario'],
            'usuarios' => $usuarios,
        ]);
    }

    public function reportes(): void
    {
        $this->reporte();
    }

    // Crea un nuevo usuario — recibe POST con Ajax
    public function crear(): void
    {
        if (!isset($_SESSION['usuario'])) {
            http_response_code(401);
            exit;
        }
        $this->soloSuperAdmin();

        $modelo    = new Usuario();
        $resultado = $modelo->crear([
            'roles'          => $_POST['roles'],
            'nombre_usuario' => trim($_POST['nombre_usuario']),
            'clave'          => $_POST['clave'],
        ]);

        header('Content-Type: application/json');
        echo json_encode($resultado);
    }

    // Elimina un usuario — recibe POST con Ajax
    public function eliminar(): void
    {
        if (!isset($_SESSION['usuario'])) {
            http_response_code(401);
            exit;
        }
        $this->soloSuperAdmin();

        $modelo = new Usuario();
        $modelo->eliminar((int) $_POST['id_usuario']);

        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'mensaje' => 'Usuario eliminado']);
    }

    // Edita un usuario — recibe POST con Ajax
    public function editar(): void
    {
        if (!isset($_SESSION['usuario'])) {
            http_response_code(401);
            exit;
        }
        $this->soloSuperAdmin();

        $modelo    = new Usuario();
        $resultado = $modelo->editar([
            'id_usuario'     => (int) $_POST['id_usuario'],
            'roles'          => $_POST['roles'],
            'nombre_usuario' => trim($_POST['nombre_usuario']),
            'clave'          => $_POST['clave'] ?? '',
        ]);

        header('Content-Type: application/json');
        echo json_encode($resultado);
    }
}
