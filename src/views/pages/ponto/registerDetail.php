<?php $render('header', ['loggedUser' => $loggedUser]); $render('menuHome');?>
<div class="editarRegistroTable">
    <h1 class="pontoTitle">Ponto de <?=$user->name;?> (<?=$user->id;?>) - Mes: <?=$registers[0]->month;?></h1><hr/>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Data e Hora</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($registers as $register): ?>
                <tr>
                    <td><?=$register->date;?></td>
                    <td><button class="btn btn-primary"><a href="<?=$base;?>/academico/editarPonto/<?=$register->id;?>">Editar</a></button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php $render('footer'); ?>