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