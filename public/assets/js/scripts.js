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
        document.querySelector("#flash").innerHTML = null;
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

    let body = {
        id: id.value,
        password1: password1.value,
        password2: password2.value
    };

    try{
        let request = await fetch('http://localhost/portal/public/academico/updateUser', {
            method: 'POST',
            body: JSON.stringify({
                body: body
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        document.querySelector("#flash").innerHTML = await request.json();
    }catch(e){
        document.querySelector("#flash").innerHTML = "Erro: " + e;
    }
    
}

function showUserContent(){
    const div = document.querySelector(".menuUser");
    const div2 = document.querySelector(".menuUserContent");
    const name = document.querySelector(".nameHeader");

    if(div2.classList.contains('hide')){
        div2.classList.remove('hide');
        div2.classList.add('show');
        name.style.color = "black";
        div.style.backgroundColor = '#c0c0c0';
    }else{
        name.style.color = "";
        div.style.backgroundColor = '';
        div2.classList.add('hide');
        div2.classList.remove('show');
    }
}

// function userSearch(){
//     const id = document.getElementById("id");

//     fetch('http://localhost/portal/public/academico/user/'+id.value)
//         .then(function(resultado){
//             return resultado.json();
//         })
//         .then(function(json){
//             userShow(json);
//         })
//         .catch(error){
//             console.log("Deu ruim: "+e);
//         }
// }

// function userShow(user){
    
// }