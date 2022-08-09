<?php $render('header'); ?>
<header>
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
    <?=$_SESSION['flash'];?>
</header>
<?php $render('footer'); ?>