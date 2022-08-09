<?php $render('header'); ?>
<button><a href="<?=$base;?>/academico/menu">Voltar</a></button>
<button><a href="<?=$base;?>/academico/registrarUsuario">Registrar Usuario</a></button>
<button onclick="showUsers()">Ver Usuarios</button>
<button><a href="<?=$base;?>/academico/acessoUsuario"></a>Acesso Usuario</button>
<div class="table">
    <table id="table" class="users-table hide">
        <thead>
        <th>Codigo</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>CPF</th>
        <th>Data de Nascimento</th>
        <th>Sexo</th>
        <th>Estudante</th>
        <th>Funcionario</th>
        <th>Professor</th>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?=$user->id;?></td>
                    <td><?=$user->name;?></td>
                    <td><?=$user->email;?></td>
                    <td><?=$user->cpf;?></td>
                    <td><?=$user->birthdate;?></td>
                    <td><?=$user->gender;?></td>
                    <td><?=$user->student;?></td>
                    <td><?=$user->employee;?></td>
                    <td><?=$user->teacher;?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?=$_SESSION['flash'];?>
<?php $render('footer'); ?>