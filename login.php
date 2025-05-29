<?php

session_start();

require_once('./funciones/funciones_input.php');
require_once('./database/conexion.php');
require_once('./database/consultas_usuarios.php');

$email = $_POST['email'] ?? null;
//Saneo de email
$email = filter_var($email, FILTER_VALIDATE_EMAIL);

$contrasena = $_POST['contrasena'] ?? null;
//Saneo de contraseña
$contrasena = test_input($contrasena);

//Errores de validación.
$errores = [];

if( $_SERVER['REQUEST_METHOD'] == 'POST' )
{

    $usuario = getUsuarioLogin($conexion, $email, $contrasena);
    
    if( $usuario ){
        
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'rol' => $usuario['rol']
        ];

        header('Location: ./index.php');

    }else{
        array_push($errores, 'Los datos ingresados son incorrectos');
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

    <title> Iniciar sesión </title>
</head>

<body>

    <div class="container">
        <h1> Iniciar sesión </h1>

        <ul>
            <?php foreach($errores as $error): ?>
                <li class="text-danger"> <?php echo $error ?> </li>
            <?php endforeach ?>
        </ul>

        <form action="/login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label"> Email </label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>">                
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contrasena" id="contrasena">
            </div>
            <button type="submit" class="btn btn-primary"> Iniciar sesión </button>
        </form>

    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>