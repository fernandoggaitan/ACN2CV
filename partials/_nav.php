<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if($usuario): ?>
          <li class="nav-item">
            <a class="nav-link" href="/index.php"> Inicio </a>
          </li>
          <?php if($usuario['rol'] == 'Administrador' or $usuario['rol'] == 'Empleado'): ?>
            <li class="nav-item">
              <a class="nav-link" href="/lista_usuarios.php"> Lista de usuarios </a>
            </li>
          <?php endif ?>
            <li class="nav-item">
              <form action="/logout.php" method="post">
                <button type="submit" class="btn btn-danger"> Logout </button>
              </form>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="/login.php"> Login </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/login.php"> Registro </a>
            </li>
          <?php endif ?>
      </ul>
    </div>
  </div>
</nav>