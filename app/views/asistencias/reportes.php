<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Reporte de Asistencias</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/reportes-asistencia.css">
</head>

<body>

    <?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>

    <main>
        <nav class="breadcrumb">
            <span>Inicio</span>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Asistencia</span>
            <i class="fa-solid fa-chevron-right"></i>
            <span id="breadcrumb-page">Reportes</span>
        </nav>

        <div class="main-content">

            <!-- ENCABEZADO -->
            <div class="dashboard-header">
                <h2 class="section-title">
                    <i class="fa-solid fa-calendar-check"></i>
                    Reporte de Asistencias
                </h2>
                <span class="badge-total">
                    <?php echo count($asistencias); ?> registro(s)
                </span>
            </div>

            <!-- FILTRO POR FECHA -->
            <div class="filtro-fecha">
                <form method="GET" action="">
                    <label for="fecha">
                        <i class="fa-regular fa-calendar"></i>
                        Seleccionar fecha:
                    </label>
                    <input
                        type="date"
                        id="fecha"
                        name="fecha"
                        value="<?php echo htmlspecialchars($fecha); ?>"
                        max="<?php echo date('Y-m-d'); ?>">
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Buscar
                    </button>
                </form>
                <p class="fecha-mostrada">
                    Mostrando resultados del:
                    <strong><?php echo date('d/m/Y', strtotime($fecha)); ?></strong>
                </p>
            </div>

            <!-- TABLA -->
            <div class="table-responsive">
                <?php if (empty($asistencias)): ?>
                    <div class="empty-state">
                        <i class="fa-solid fa-circle-info"></i>
                        <p>No hay asistencias registradas para esta fecha.</p>
                    </div>
                <?php else: ?>
                    <table class="tabla-asistencias">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Empleado</th>
                                <th>Cargo</th>
                                <th>Hora entrada</th>
                                <th>Hora salida</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($asistencias as $i => $a): ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td>
                                        <div class="empleado-info">
                                            <i class="fa-solid fa-user-circle empleado-icon"></i>
                                            <?php echo htmlspecialchars($a['nombre'] . ' ' . $a['apellido']); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="cargo-label">
                                            <?php echo htmlspecialchars($a['nombre_cargo']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <i class="fa-regular fa-clock icono-hora"></i>
                                        <?php echo date('h:i A', strtotime($a['hora_entrada'])); ?>
                                    </td>
                                    <td>
                                        <?php if ($a['hora_salida']): ?>
                                            <i class="fa-regular fa-clock icono-hora"></i>
                                            <?php echo date('h:i A', strtotime($a['hora_salida'])); ?>
                                        <?php else: ?>
                                            <span class="sin-salida">— Sin salida —</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="estado-badge estado-<?php echo $a['estado']; ?>">
                                            <?php echo ucfirst(htmlspecialchars($a['estado'])); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
</body>

</html>