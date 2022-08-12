<?php $render('header'); ?>
<button><a href="<?=$base;?>/academico/usuarios">Voltar</a></button><br/>
<?=$_SESSION['flash']?>
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
    <label>
        Professor?<br/>
        <select name="teacher">
            <option value="1">Sim</option>
            <option value="0">Nao</option>
        </select>
    </label><br/>
    <label>
        Estudante?<br/>
        <select name="student">
            <option value="1">Sim</option>
            <option value="0">Nao</option>
        </select>
    </label><br/>
    <label>
        Funcionario?<br/>
        <select name="employee">
            <option value="1">Sim</option>
            <option value="0">Nao</option>
        </select>
    </label><br/>
    <input type="submit" value="Cadastrar" />
</form>
<?php $render('footer'); ?>