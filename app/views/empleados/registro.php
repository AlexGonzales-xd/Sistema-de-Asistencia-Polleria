<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE_BUSINESS; ?> - Registro de Empleado</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/registro-empleado.css">
</head>
<body>
    <?php include __DIR__ . '/../layouts/sidebar-dashboard.php'; ?>

    <main>
        <nav class="breadcrumb">
            <span>Dashboard</span>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Empleados</span>
            <i class="fa-solid fa-chevron-right"></i>
            <span id="breadcrumb-page">Registro</span>
        </nav>

        <div class="main-content">
            <div class="registro-header">
                <div>
                    <h2 class="registro-title">
                        <i class="fa-solid fa-user-plus"></i>
                        Registrar empleado
                    </h2>
                    <p class="registro-subtitle">Completa los campos para agregar un nuevo trabajador</p>
                </div>
                <a href="<?php echo BASE_URL; ?>/empleados/reportes" class="btn-volver">
                    <i class="fa-solid fa-arrow-left"></i>
                    Volver
                </a>
            </div>

            <form action="<?php echo BASE_URL; ?>/empleados/guardar" method="post" class="registro-form">

                <!-- FILA 1: Nombre y Apellido -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">
                            <i class="fa-solid fa-user"></i> Nombre
                        </label>
                        <input type="text" id="nombre" name="nombre"
                               placeholder="Ej: Juan Carlos" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="apellido">
                            <i class="fa-solid fa-user"></i> Apellido
                        </label>
                        <input type="text" id="apellido" name="apellido"
                               placeholder="Ej: Perez Gomez" required maxlength="100">
                    </div>
                </div>

                <!-- FILA 2: DNI y Celular -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="dni">
                            <i class="fa-solid fa-id-card"></i> DNI
                        </label>
                        <input type="text" id="dni" name="dni"
                               placeholder="12345678" required maxlength="8"
                               pattern="\d{8}" title="El DNI debe tener 8 dígitos">
                    </div>
                    <div class="form-group">
                        <label for="celular">
                            <i class="fa-solid fa-mobile-screen"></i> Celular
                        </label>
                        <input type="text" id="celular" name="celular"
                               placeholder="987654321" required maxlength="20">
                    </div>
                </div>

                <!-- FILA 3: Correo y Género -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="correo">
                            <i class="fa-solid fa-envelope"></i> Correo electrónico
                        </label>
                        <input type="email" id="correo" name="correo"
                               placeholder="juan@polleria.com" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="genero">
                            <i class="fa-solid fa-venus-mars"></i> Género
                        </label>
                        <select id="genero" name="genero" required>
                            <option value="" disabled selected>Seleccionar...</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                </div>

                <!-- FILA 4: Cargo (ancho completo) -->
                <div class="form-row">
                    <div class="form-group form-group--full">
                        <label for="cargo">
                            <i class="fa-solid fa-briefcase"></i> Cargo
                        </label>
                        <select id="cargo" name="cargo" required>
                            <option value="" disabled selected>Seleccionar cargo...</option>
                            <?php foreach ($lista_cargo as $cargitos): ?>
                                <option value="<?php echo $cargitos['id_cargo']; ?>">
                                    <?php echo htmlspecialchars($cargitos['nombre_cargo']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- BOTONES -->
                <div class="form-actions">
                    <a href="<?php echo BASE_URL; ?>/empleados/reportes" class="btn-cancelar">
                        Cancelar
                    </a>
                    <button type="submit" class="btn-guardar">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Guardar empleado
                    </button>
                </div>

            </form>
        </div>
    </main>

    <script src="<?php echo BASE_URL; ?>/public/js/dashboard.js"></script>
</body>
</html>