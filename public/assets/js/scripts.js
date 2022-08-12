function dropdown(){
    const menu = document.getElementById("dropdown");
    if(menu.classList.contains('show')){
        menu.classList.remove('show');
    }else{
        menu.classList.add('show');
    }
}

function showUsers(){
    const table = document.getElementById("table");
    if(table.classList.contains('hide')){
        table.classList.remove('hide');
    }else{
        table.classList.add('hide');
    }
}

function searchUser(){
    const id = document.getElementById("id");

    fetch('http://localhost/portal/public/academico/user/'+id.value)
        .then(function(resultado){
            return resultado.json();
        })
        .then(function(json){
            showUser(json);
        })
        .catch(function(error){
            console.log("Deu ruim!" + error);
        })
}   

function showUser(user){
    if(!user){
        document.querySelector("#flash").innerHTML = 'Usuario nao encontrado!';
    }else{
        document.querySelector("#name").innerHTML = "Nome: "+user.name;
        document.querySelector("#cpf").innerHTML = "CPF: "+user.cpf;
        document.querySelector("#birthdate").innerHTML = "Data de nascimento: "+user.birthdate;
        document.querySelector("#password1").value = user.password;
        document.querySelector("#password2").value = user.password;
        document.querySelector("#teacher").innerHTML = "Professor: "+user.teacher;
        document.querySelector("#student").innerHTML = "Aluno: "+user.student;
        document.querySelector("#employee").innerHTML = "Funcionario: "+user.employee;
        
        document.querySelector("#id").setAttribute("disabled", "disabled");
        document.querySelector("#password1").removeAttribute("disabled");
        document.querySelector("#password2").removeAttribute("disabled");
        document.querySelector("#submit").removeAttribute("disabled");
    }
}

async function updateUser(){
    const id = document.getElementById("id");
    const password1 = document.getElementById("password1");
    const password2 = document.getElementById("password2");

    let body = [
        id.value,
        password1.value,
        password2.value
    ];
    console.log(body);

    let request = await fetch('http://localhost/portal/public/academico/updateUser/'+id.value, {
        method: 'POST',
        body: JSON.stringify({
            title: 'body',
            body: body
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
}