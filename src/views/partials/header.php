<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?=$base;?>/assets/css/style.css" />
    <title><?=$_SESSION['title'];?></title>
</head>
<body>
<header>
    <div>

    </div>
</header>
<nav class="menu">
    <ul>
        <li><a href="#">Cadastro</a>
            <ul>
                <li><a href="<?=$base;?>/academico/acessoUsuario">Acesso Usuario</a></li>
                <li><a href="<?=$base;?>/academico/usuarios">Usuarios</a></li>
            </ul>
        </li>
        <li><a href="#">Sistemas</a>
            <ul>
                <li><a href="<?=$base;?>/academico/portal/home">Portal</a></li>
                <li><a href="">Reserva de Recursos</a></li>
            </ul>
        </li>
        <li><a href="<?=$base;?>/academico/logout">Sair</a></li>
    </ul>
</nav>