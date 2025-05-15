<?php

$nombre = $_COOKIE['nombre_cookie'] ?? null;

if( $_SERVER['REQUEST_METHOD'] == 'POST' )
{

    $nombre = $_POST['nombre'];

    //timestamp.
    $time = time() + 3600;

    setcookie( 'nombre_cookie', $nombre, $time, '/' );
    
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
        <h1> Prueba de cookies </h1>

        <?php if($nombre): ?>
            <p> Hola, <?php echo $nombre ?> </p>
        <?php else: ?>
            <p> Hola, desconocida/o. Por favor presentate </p>
        <?php endif ?>

        <form action="/test_cookie.php" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label"> Nombre </label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>">                
            </div>
            <button type="submit" class="btn btn-primary"> Presentarme </button>
        </form>

    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>