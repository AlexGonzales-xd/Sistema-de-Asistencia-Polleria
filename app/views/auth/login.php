<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TITLE_BUSINESS es la constante que definimos en config/config.php -->
    <title><?php echo TITLE_BUSINESS; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/login.css">
</head>

<body>

    <!-- Si el controlador encontró un error, lo mostramos aquí.
         htmlspecialchars() convierte caracteres peligrosos (< > " &) a texto plano
         para evitar que alguien inyecte código HTML o JavaScript malicioso. -->
    <?php if (isset($error) && $error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>



    <div class="container">
        <!-- IZQUIERDA -->
        <div class="left">
            <img src="https://elcomercio.pe/resizer/BC69Wu2qqfEnwQSMPQk_y-G3x2c=/640x0/smart/filters:format(jpeg):quality(75)/cloudfront-us-east-1.images.arcpublishing.com/elcomercio/U5KNNXQ3BJE6JG6AROJH52NW74.jpg" alt="Login">
        </div>

        <!-- DERECHA -->
        <div class="right">
            <h2>Iniciar Sesión</h2>
            <!-- action="" envía el formulario a la misma URL donde estamos.
         method="POST" envía los datos de forma segura en el cuerpo de la petición,
         no en la URL como haría method="GET". -->
            <form action="" method="POST">
                <!-- El atributo "for" del label debe coincidir con el "id" del input
             para que al hacer clic en el texto, el cursor vaya al campo. -->
                <label for="user">Usuario: </label>
                <!-- name="user" es el nombre con el que llegan los datos a $_POST['user'] -->
                <!-- required le dice al navegador que no envíe el formulario si el campo está vacío -->
                <input id="user" type="text" name="user" required>

                <label for="pass">Contraseña: </label>
                <!-- type="password" oculta lo que escribe el usuario con asteriscos -->
                <input id="pass" type="password" name="pass" required>

                <!-- type="submit" es lo que hace que el botón envíe el formulario.
             Con type="button" el formulario nunca se envía. -->
                <button type="submit">Enviar</button>

            </form>
        </div>
    </div>



</body>

</html>