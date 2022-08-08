<?php $render('header'); ?>
<header>
    <div class="dropdown">
        <button class="dropbtn">Portal de Ensino</button>
        <form action="" class="drop-content">
            <label>
                <input type="text" name="login" placeholder="Codigo ou CPF" />
            </label><br/>
            <label>
                <input type="password" name="password" placeholder="Senha" />
            </label>
            <input type="submit" value="Entrar" />
        </form>
    </div>
</header>
<?php $render('footer'); ?>