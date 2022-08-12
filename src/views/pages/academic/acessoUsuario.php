<?php $render('header'); ?>
<button><a href="<?=$base;?>/academico/usuarios">Voltar</a></button>

<h1>Acesso Usuario</h1><hr/>

<label>
    * Codigo: <br/>
    <input type="text" name="id" id="id" />
</label>
<button onclick="searchUser()">Pesquisar</button>
<div id="flash">

</div><hr/>

<label id="name">
    Nome: 
</label><br/>
<label id="cpf">
    CPF: 
</label><br/>
<label id="birthdate">
    Data de nascimento: 
</label> <hr/>

<label>
    Senha: <br/>
    <input type="password" name="password1" id="password1" disabled /> <br/>
</label>
<label>
    Confirmar senha: <br/>
    <input type="password" name="password2" id="password2" disabled /> <br/>
</label>
<button onclick="updateUser()" id="submit" value="Salvar" disabled>Salvar</button><hr/>

<div>
    <label id="teacher">
        Professor: 
    </label><br/>
    <label id="student">
        Aluno: 
    </label><br/>
    <label id="employee">
        Funcionario: 
    </label>
</div>

<?php $render('footer'); ?>