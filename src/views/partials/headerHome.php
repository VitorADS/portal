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
<header class="p-5 bg-white text-dark headerHome">
    <div class="homeLogo">
        <div class="homeEsquerda">
            <img src="https://www.unoesc.edu.br/images/front_end/logo_unoesc.jpg" alt="Logo"><br/>
        </div>
    </div>

        <div class="homeCentro">
            <input type="text" name="keywords" class="form-control" placeholder="Pesquisar..."/> <button class="btn btn-primary"><i class="fa fa-search"></i></button>
        </div>

        <div class="homeDireita">
            <div class="dropdown">
                <button onclick="dropdown()" class="dropbtn">Portal de Ensino</button><br/>
                <form action="<?=$base;?>/login" method="POST" id="dropdown" class="dropdown-content">
                    <label>
                        <input type="text" name="login" placeholder="Codigo ou CPF" />
                    </label><br/>
                    <label>
                        <input type="password" name="password" placeholder="Senha" />
                    </label><br/>
                    <input type="submit" value="Entrar" />
                </form>
            </div>
        </div>
    
</header>