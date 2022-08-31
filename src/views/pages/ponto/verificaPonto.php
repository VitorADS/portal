<?php $render('header', ['loggedUser' => $loggedUser]); $render('menuHome');?>
<div class="divPonto">
    <div class="pontoTable">
        <h1 class="pontoTitle">Verificar Ponto</h1><hr>
        <?php if($_SESSION['flash'] != 1 and $_SESSION['flash'] != ''): ?>
            <div class="alert alert-warning alertPonto" role="alert">
                <p><?=$_SESSION['flash'];?></p>
            </div>
        <?php endif; ?>
        <?php if($_SESSION['flash'] == 1): ?>
            <div class="alert alert-success alertPonto" role="alert">
                <p>Alterado com sucesso!</p>
            </div>
        <?php endif; ?>
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
                            <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?=$user->id;?>">Ver</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</div>
<div class="modalPonto">
<?php foreach($users as $user): ?>
    <div class="modal fade" id="modal<?=$user->id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Meses Pendentes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Mes</th>
                        <th>Acao</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($registers as $register):?>
                        <?php if($register->idUser == $user->id): ?>
                            <tr>
                                <td><?=$register->month;?></td>
                                <td><button class="btn btn-primary"><a href="<?=$base;?>/academico/verificarPonto/<?=$register->id;?>">Ver Mes</a></button></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>
</div>

<?php $render('footer'); ?>