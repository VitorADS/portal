<nav class="navbar navbar-expand-sm bg-white navbar-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav"> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Cadastro</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?=$base;?>/academico/acessoUsuario">Acesso Usuario</a></li>
            <li><a class="dropdown-item" href="<?=$base;?>/academico/usuarios">Lista de Usuarios</a></li>
            <li><a class="dropdown-item" href="<?=$base;?>/academico/registrarUsuario">Registrar Usuario</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Sistemas</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?=$base;?>/academico/portal/home">Portal</a></li>
            <li><a class="dropdown-item" href="#">Reserva de Recursos</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>