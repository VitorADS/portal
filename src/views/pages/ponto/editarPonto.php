<?php $render('header', ['loggedUser' => $loggedUser]); $render('menuHome');?>
<div class="editarPonto">
    <h4>Usuario: <?=$user->name;?> (<?=$user->id;?>) Mes referente: <?=$register->month;?></h4><hr/>
    <form action="<?=$base;?>/academico/editarPontoAction" method="POST" class="formEditarPonto">
        <label for="">
            <input class="form-control" type="datetime" name="date" value="<?=$register->date;?>" />
        </label>
        <label for="">
            <input type="hidden" name="register" value="<?=$register->id;?>" />
            <input class="btn btn-primary" type="submit" value="Alterar" />
        </label>
    </form>
</div>
<?php $render('footer'); ?>