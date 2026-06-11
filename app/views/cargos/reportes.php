<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Cargos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/cargos.css">
</head>

<body>

    <?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>

    <main>

        <!-- BREADCRUMB -->
        <nav class="breadcrumb">
            <span>Inicio</span>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Cargos</span>
            <i class="fa-solid fa-chevron-right"></i>
            <span id="breadcrumb-page">Reportes</span>
        </nav>

        <div class="main-content">

            <!-- CABECERA -->
            <div class="cargos-header">
                <div>
                    <h2 class="cargos-title">
                        <i class="fa-solid fa-briefcase"></i>
                        Gestión de Cargos
                    </h2>
                    <p class="cargos-subtitle">Administra los puestos de trabajo del personal</p>
                </div>
                <button class="btn-nuevo" onclick="abrirModalNuevo()">
                    <i class="fa-solid fa-plus"></i>
                    Nuevo cargo
                </button>
            </div>

            <!-- BUSCADOR -->
            <div class="cargos-toolbar">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="buscador" placeholder="Buscar cargo..." onkeyup="filtrarTabla()">
                </div>
                <span class="total-badge" id="total-badge">
                    <?php echo count($cargos ?? []); ?> cargos
                </span>
            </div>

            <!-- TABLA -->
            <div class="table-responsive">
                <table class="cargos-table" id="tablaCargos">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre del cargo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cargos)): ?>
                            <?php foreach ($cargos as $index => $cargo): ?>
                                <tr>
                                    <td class="td-id"><?php echo $cargo['id_cargo']; ?></td>
                                    <td class="td-nombre">
                                        <i class="fa-solid fa-tag td-icon"></i>
                                        <?php echo htmlspecialchars($cargo['nombre_cargo']); ?>
                                    </td>
                                    <td class="td-acciones">
                                        <button class="btn-editar" title="Editar"
                                            onclick="abrirModalEditar(<?php echo $cargo['id_cargo']; ?>, '<?php echo htmlspecialchars($cargo['nombre_cargo'], ENT_QUOTES); ?>')">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Editar
                                        </button>
                                        <button class="btn-eliminar" title="Eliminar"
                                            onclick="confirmarEliminar(<?php echo $cargo['id_cargo']; ?>, '<?php echo htmlspecialchars($cargo['nombre_cargo'], ENT_QUOTES); ?>')">
                                            <i class="fa-solid fa-trash"></i>
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="td-empty">
                                    <i class="fa-solid fa-folder-open"></i>
                                    <p>No hay cargos registrados</p>
                                    <small>Haz clic en "Nuevo cargo" para agregar uno</small>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div><!-- /main-content -->

    </main>

    <!-- ─── MODAL: NUEVO CARGO ─────────────────────── -->
    <div class="modal-overlay" id="modalNuevo">
        <div class="modal-box">
            <div class="modal-header">
                <h3><i class="fa-solid fa-plus"></i> Nuevo cargo</h3>
                <button class="modal-close" onclick="cerrarModal('modalNuevo')">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form method="POST" action="<?php echo BASE_URL; ?>/cargos/store">
                <div class="modal-body">
                    <label for="nombre_nuevo">Nombre del cargo</label>
                    <input type="text" id="nombre_nuevo" name="nombre_cargo"
                        placeholder="Ej: Cocinero" required maxlength="50">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancelar" onclick="cerrarModal('modalNuevo')">Cancelar</button>
                    <button type="submit" class="btn-guardar">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ─── MODAL: EDITAR CARGO ─────────────────────── -->
    <div class="modal-overlay" id="modalEditar">
        <div class="modal-box">
            <div class="modal-header">
                <h3><i class="fa-solid fa-pen-to-square"></i> Editar cargo</h3>
                <button class="modal-close" onclick="cerrarModal('modalEditar')">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form method="POST" action="<?php echo BASE_URL; ?>/cargos/update">
                <input type="hidden" id="edit_id" name="id_cargo">
                <div class="modal-body">
                    <label for="nombre_editar">Nombre del cargo</label>
                    <input type="text" id="nombre_editar" name="nombre_cargo"
                        placeholder="Nombre del cargo" required maxlength="50">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancelar" onclick="cerrarModal('modalEditar')">Cancelar</button>
                    <button type="submit" class="btn-guardar">
                        <i class="fa-solid fa-floppy-disk"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ─── MODAL: CONFIRMAR ELIMINAR ───────────────── -->
    <div class="modal-overlay" id="modalEliminar">
        <div class="modal-box modal-box--danger">
            <div class="modal-header">
                <h3><i class="fa-solid fa-triangle-exclamation"></i> Confirmar eliminación</h3>
                <button class="modal-close" onclick="cerrarModal('modalEliminar')">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-danger-text">
                    ¿Estás seguro de eliminar el cargo <strong id="nombre-a-eliminar"></strong>?
                </p>
                <p class="modal-danger-hint">Esta acción no se puede deshacer.</p>
            </div>
            <form method="POST" action="<?php echo BASE_URL; ?>/cargos/destroy">
                <input type="hidden" id="eliminar_id" name="id_cargo">
                <div class="modal-footer">
                    <button type="button" class="btn-cancelar" onclick="cerrarModal('modalEliminar')">Cancelar</button>
                    <button type="submit" class="btn-eliminar-confirm">
                        <i class="fa-solid fa-trash"></i> Sí, eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
    <script src="<?php echo BASE_URL; ?>/public/js/cargos.js"></script>
</body>

</html>