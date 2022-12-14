<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?=$base;?>/assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <title><?=$_SESSION['title'];?></title>
</head>
<body>
<header class="p-5 bg-primary text-white">
    <div class="headerEsquerda">
      <h1>Portal de Ensino</h1>  
    </div>
    <div class="headerDireita">
      <div onclick="showUserContent()" class="dropdown-toggle text-white menuUser">
        <tag class="nameHeader">Olá, <?=$loggedUser->name;?></tag>
        <div class="menuUserContent hide">
          <ul>
            <li><a href="">Meus Dados</a></li>
            <li><a href="<?=$base;?>/academico/logout">Sair</a></li>
          </ul>
        </div>
      </div>
    </div>
</header>