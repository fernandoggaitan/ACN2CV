<?php

require_once ('./_init.php');

require_once('./funciones/funciones_input.php');
require_once('./database/conexion.php');
require_once('./database/consultas_usuarios.php');

$nombre = $_POST['nombre'] ?? null;
//Saneo de nombre.
$nombre = test_input($nombre);

$email = $_POST['email'] ?? null;
//Saneo de email
$email = filter_var($email, FILTER_VALIDATE_EMAIL);

$contrasena = $_POST['contrasena'] ?? null;
//Saneo de contraseña
//$contrasena = filter_password($contrasena);

$cv = $_FILES['cv'] ?? null;

//Errores de validación.
$errores = [];

if( $_SERVER['REQUEST_METHOD'] == 'POST' )
{

    //Archivo temporal
    $from = $cv['tmp_name'];

    $time = time();
    //Path donde se va a guardar.
    $to = "./cvs/{$time}{$cv['name']}";

    if( empty($nombre) ){
        array_push($errores, 'Usted debe ingrear un nombre');
    }

    if( empty($email) ){
        array_push($errores, 'Usted debe ingrear un correo electrónico con un formato correcto');
    }

    if( empty($contrasena) ){
        array_push($errores, 'Usted debe ingrear una contraseña con un formato correcto (caracteres alfabéticos con minúscula y mayúscula, un número y un caracter especial)');
    }

    //Validación de archivo
    if( $cv['error'] != 0 ){
        array_push($errores, 'Por favor adjunte un documento');
    }

    if( count($errores) == 0 ){
        //No hay errores.

        //Subir el documento.
        move_uploaded_file($from, $to);

        //Hash de contraseña
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

        addUsuario($conexion, [
            'nombre' => $nombre,
            'email' => $email,
            'contrasena' => $contrasena,
            'cv' => $to,
            'rol' => 'Postulante'
        ]);

        header('Location: registro_resultado.php');
    }
    
}

?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title> Registro </title>
</head>

<body>

    <?php require('./partials/_nav.php') ?>

    <div class="container">
        <h1> Registrarse </h1>

        <ul>
            <?php foreach($errores as $error): ?>
                <li class="text-danger"> <?php echo $error ?> </li>
            <?php endforeach ?>
        </ul>

        <form action="./registro.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label"> Nombre </label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"> Email </label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>">                
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contrasena" id="contrasena">
            </div>
            <div class="mb-3">
                <label for="cv" class="form-label">Cv</label>
                <input type="file" class="form-control" name="cv" id="cv">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="contrato">
                <label class="form-check-label" for="contrato"> Acepto los términos y acepto registrarme </label>
            </div>
            <button type="submit" class="btn btn-primary" disabled> Postularme </button>
        </form>

    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>