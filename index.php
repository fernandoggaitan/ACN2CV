<?php

session_start();

$usuario = $_SESSION['usuario'] ?? null;

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
    <title>Document</title>
</head>
<body>
    <h1> Hola <?php echo $usuario['nombre'] ?> </h1>

    <form action="./logout.php" method="post">
        <button type="submit" class="btn btn-primary"> Cerrar sesión </button>
    </form>

</body>
</html>