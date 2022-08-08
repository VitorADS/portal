<?php $render('header'); ?>
<button><a href="<?=$base;?>/academico/usuarios">Voltar</a></button>
<form action="<?=$base;?>/academico/registrarUsuarioAction" method="POST">
    <label>
        Nome:
        <input type="text" name="name" />
    </label><br/>
    <label>
        E-mail:
        <input type="email" name="email" />
    </label><br/>
    <label>
        CPF:
        <input type="text" name="cpf" />
    </label><br/>
    <label>
        Data de nascimento:
        <input type="date" name="birthdate" />
    </label><br/>
    <label>Sexo: 
        <select name="gender">
            <option value="0">Feminino</option>
            <option value="1">Masculino</option>
        </select>
    </label><br/>
    <input type="submit" value="Cadastrar" />
</form>
<?php $render('footer'); ?>