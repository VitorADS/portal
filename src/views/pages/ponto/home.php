<?php $render('headerPonto');?>
<div class="ponto">
    <form action="<?=$base;?>/ponto/registrarPonto" method="POST" class="formPonto">
        <div class="input-group mb-3 codigo">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Codigo</span>
            </div>
            <input type="text" name="id" class="form-control" aria-label="codigo" aria-describedby="basic-addon1" />
        </div>
        <input type="submit" value="Registrar Ponto" id="submit" class="btn btn-primary" /><hr/>
        <?php if($_SESSION['flash'] == 0): ?>
            <div class="alert alert-warning" role="alert">
                <p>Usuario nao encontrado!</p>
            </div>
        <?php endif; ?>
        <?php if($_SESSION['flash'] != '' and $_SESSION['flash'] != 0): ?>
            <div class="alert alert-success" role="alert">
                <p><?=$_SESSION['flash'];?></p>
            </div>
        <?php endif; ?>
    </form>
</div>
<?php $render('footer');?>