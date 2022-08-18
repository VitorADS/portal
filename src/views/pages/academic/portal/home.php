<?php $render('header', ['loggedUser' => $loggedUser]); $render('menuAcademico');?>
<h3 align="center">Olá, <?=$loggedUser->name;?></h3>
<?php $render('footer'); ?>