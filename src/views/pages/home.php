<?php $render('header'); ?>
<header>
    <div class="dropdown">
        <button onclick="dropdown()" class="dropbtn">Portal de Ensino</button><br/>
        <form action="" id="dropdown" class="dropdown-content">
            <label>
                <input type="text" name="login" placeholder="Codigo ou CPF" />
            </label><br/><br/>
            <label>
                <input type="password" name="password" placeholder="Senha" />
            </label><br/><br/>
            <input type="submit" value="Entrar" />
        </form>
    </div>
</header>
<?php $render('footer'); ?>