<?php $render('header', ['loggedUser' => $loggedUser]); $render('menuAcademico');?>
<h1 align="center">Olá, <?=$loggedUser->name;?></h1>
<?php $render('footer'); ?>