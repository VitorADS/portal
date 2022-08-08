<?php $render('header'); ?>
<button><a href="<?=$base;?>/academico/menu">Voltar</a></button>
<button><a href="<?=$base;?>/academico/registrarUsuario">Registrar Usuario</a></button>
<?=$_SESSION['flash'];?>
<?php $render('footer'); ?>