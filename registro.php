<?php

require_once('./funciones/funciones_input.php');

$nombre = $_POST['nombre'] ?? null;
//Saneo de nombre.
$nombre = test_input($nombre);

$email = $_POST['email'] ?? null;
//Saneo de email
$email = filter_var($email, FILTER_VALIDATE_EMAIL);

$contrasena = $_POST['contrasena'] ?? null;
//Saneo de contraseña
$contrasena = filter_password($contrasena);

//Errores de validación.
$errores = [];

if( $_SERVER['REQUEST_METHOD'] == 'POST' )
{

    if( empty($nombre) ){
        array_push($errores, 'Usted debe ingrear un nombre');
    }

    if( empty($email) ){
        array_push($errores, 'Usted debe ingrear un correo electrónico con un formato correcto');
    }

    if( empty($contrasena) ){
        array_push($errores, 'Usted debe ingrear una contraseña con un formato correcto (caracteres alfabéticos con minúscula y mayúscula, un número y un caracter especial)');
    }

    if( count($errores) == 0 ){
        //No hay errores.
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

    <div class="container">
        <h1> Registrarse </h1>

        <ul>
            <?php foreach($errores as $error): ?>
                <li class="text-danger"> <?php echo $error ?> </li>
            <?php endforeach ?>
        </ul>

        <form action="./registro.php" method="post">
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
            <button type="submit" class="btn btn-primary"> Postularme </button>
        </form>

    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>