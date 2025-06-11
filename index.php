<?php

require_once ('./_init.php');

//Verifica si el usuario inició sesión.
if( !$usuario ){
    header('Location: ./login.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida/o</title>

    <?php require_once('./partials/_css.php') ?>

</head>
<body>

    <?php require('./partials/_nav.php') ?>

    <div class="container">
        <h1> Hola <?php echo $usuario['nombre'] ?> </h1>
        <?php if($usuario['rol'] == 'Postulante'): ?>
            <p> Estamos analizando tu perfil. Nos pondremos en contacto con vos a la brevedad. </p>
        <?php else: ?>
            <p> Gracias por trabajar con nosotros </p>
        <?php endif ?>        
    </div>

    <?php require_once('./partials/_js.php') ?>

</body>
</html>