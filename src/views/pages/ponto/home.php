<?php $render('headerPonto');?>
<div class="ponto">
    <form action="<?=$base;?>/ponto/registrarPonto" method="POST" class="formPonto">
        <div class="input-group mb-3 codigo">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Codigo</span>
            </div>
            <input type="text" name="id" class="form-control" aria-label="codigo" aria-describedby="basic-addon1" />
            <?=$_SESSION['flash'];?>
        </div>
        <input type="submit" value="Registrar Ponto" id="submit" class="btn btn-primary" />
    </form>
</div>
<?php $render('footer');?>