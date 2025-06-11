<?php

require_once ('./_init.php');

require_once('./database/conexion.php');
require_once('./database/consultas_usuarios.php');

if( !$usuario or $usuario['rol'] == 'Postulante' )
{
    header('Location: login.php');
}

$usuarios = getUsuarios($conexion);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuarios</title>

    <?php require_once('./partials/_css.php') ?>

</head>

<body>

    <?php require('./partials/_nav.php') ?>

    <div class="container">
        <h1> Lista de usuarios </h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"> Nombre </th>
                    <th scope="col"> Rol </th>
                    <th scope="col"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usu): ?>
                    <tr>
                        <td scope="row"> <?php echo $usu['id'] ?> </td>
                        <td> <?php echo $usu['nombre'] ?> </td>
                        <td> <?php echo $usu['rol'] ?> </td>
                        <td>
                            <?php if($usu['rol'] == 'Postulante'): ?>
                                <button type="submit" class="btn btn-success"> Contratar </button>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <?php require_once('./partials/_js.php') ?>

</body>

</html>