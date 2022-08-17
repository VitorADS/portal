<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?=$base;?>/assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title><?=$_SESSION['title'];?></title>
</head>
<body>
<header class="p-5 bg-primary text-white">
    <div class="headerEsquerda">
      <h1>Portal de ensino</h1>  
    </div>
    <div class="headerDireita">
      <div onclick="showUserContent()" class="nav-link dropdown-toggle menuUser">
        Olá, <?=$loggedUser->name;?>
        <div class="menuUserContent hide">
          <ul>
            <li><a href="">Meus Dados</a></li>
            <li><a href="">Sair</a></li>
          </ul>
        </div>
      </div>
    </div>
</header>