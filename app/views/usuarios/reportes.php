<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Usuarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/usuarios.css">
</head>

<body>

    <?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>

    <main>
        <nav class="breadcrumb">
            <span>Inicio</span>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Usuarios</span>
            <i class="fa-solid fa-chevron-right"></i>
            <span id="breadcrumb-page">Reportes</span>
        </nav>

        <div class="main-content">

            <!-- ENCABEZADO -->
            <div class="dashboard-header">
                <h2 class="section-title">
                    <i class="fa-solid fa-users-gear"></i>
                    Gestión de Usuarios
                </h2>
                <button class="btn-agregar" id="btn-nuevo-usuario">
                    <i class="fa-solid fa-plus"></i> Nuevo usuario
                </button>
            </div>

            <!-- TABLA -->
            <div class="table-responsive">
                <?php if (empty($usuarios)): ?>
                    <div class="empty-state">
                        <i class="fa-solid fa-circle-info"></i>
                        <p>No hay usuarios registrados.</p>
                    </div>
                <?php else: ?>
                    <table class="tabla-asistencias">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $i => $u): ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td>
                                        <div class="empleado-info">
                                            <i class="fa-solid fa-user-circle empleado-icon"></i>
                                            <?php echo htmlspecialchars($u['nombre_usuario']); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="rol-badge rol-<?php echo $u['roles']; ?>">
                                            <?php echo ucfirst($u['roles']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="acciones">
                                            <button class="btn-editar"
                                                data-id="<?php echo $u['id_usuario']; ?>"
                                                data-nombre="<?php echo htmlspecialchars($u['nombre_usuario']); ?>"
                                                data-rol="<?php echo $u['roles']; ?>">
                                                <i class="fa-solid fa-pen"></i> Editar
                                            </button>
                                            <button class="btn-eliminar"
                                                data-id="<?php echo $u['id_usuario']; ?>"
                                                data-nombre="<?php echo htmlspecialchars($u['nombre_usuario']); ?>">
                                                <i class="fa-solid fa-trash"></i> Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <!-- MODAL CREAR / EDITAR -->
    <div class="modal-overlay" id="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <h3 id="modal-titulo">Nuevo Usuario</h3>
                <button class="modal-cerrar" id="modal-cerrar">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="input-id">

                <div class="campo">
                    <label>Nombre de usuario</label>
                    <input type="text" id="input-nombre" placeholder="Ej: Roronoa">
                </div>
                <div class="campo">
                    <label>Contraseña <span id="clave-hint">(dejar vacío para no cambiar)</span></label>
                    <input type="password" id="input-clave" placeholder="Contraseña">
                </div>
                <div class="campo">
                    <label>Rol</label>
                    <select id="input-rol">
                        <option value="admin">Admin</option>
                        <option value="superadmin">Superadmin</option>
                    </select>
                </div>
                <p class="modal-error" id="modal-error"></p>
            </div>
            <div class="modal-footer">
                <button class="btn-cancelar" id="btn-cancelar">Cancelar</button>
                <button class="btn-guardar" id="btn-guardar">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
            </div>
        </div>
    </div>

    <script>
        let BASE_URL = '<?php echo BASE_URL; ?>';
    </script>
    <script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/js/usuarios.js"></script>
</body>

</html>