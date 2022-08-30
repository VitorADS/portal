<?php $render('header', ['loggedUser' => $loggedUser]); $render('menuHome');?>
<div class="divPonto">
    <div class="pontoTable">
    <h2>Verificar Ponto</h2><hr>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?=$user->id;?></td>
                        <td><?=$user->name;?></td>
                        <td><button class="btn btn-primary"><a href="<?=$base;?>/academico/verificarPonto/<?=$user->id;?>">Ver</a></button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $render('footer'); ?>