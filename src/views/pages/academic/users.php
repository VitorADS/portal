<?php $render('header', ['loggedUser' => $loggedUser]); $render('menuHome');?>
<div class="table">
    <table id="table">
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