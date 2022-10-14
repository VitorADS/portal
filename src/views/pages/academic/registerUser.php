<?php $render('header', ['loggedUser' => $loggedUser]); $render('menuHome');?>
<form action="<?=$base;?>/academico/registrarUsuarioAction" method="POST">
    <div class="form-cadastro-user">
        <h2>Cadastro de usuario</h2><hr/>
        <label>
            Nome: <br/>
            <input type="text" name="name" />
        </label><br/>
        <label>
            E-mail:<br/>
            <input type="email" name="email" class="input-style"/>
        </label><br/>
        <label>
            CPF:<br/>
            <input type="text" name="cpf" />
        </label><br/>
        <label>
            Data de nascimento: <br/>
            <input type="date" name="birthdate" class="input-style"/>
        </label><br/>
        <label>Sexo: <br/>
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
        <input type="submit" value="Cadastrar" class="cadastro-submit"/>
    </div>
</form>
<?php $render('footer'); ?>