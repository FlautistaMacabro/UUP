let btnDelete = document.querySelectorAll(".btn-delete");
let avisoName = document.getElementById("name-delete-aviso");
let idAviso = document.getElementById("id-delete-aviso");



function insertAulaName(event) {
    let divList = ((event.currentTarget).parentNode).parentNode;
    let nome = ((divList.children[0]).innerText);
    let id = ((divList.children[2]).innerText);

    avisoName.innerText = nome;
    idAviso.innerText = id;
}


btnDelete.forEach(button => {
    button.addEventListener('click', insertAulaName)
})



let btnEditar = document.querySelectorAll(".btn-editar");
let url = (document.getElementsByTagName("base")[0]).href;

function getData(event) {
    let divList = ((event.currentTarget).parentNode).parentNode;
    let idAviso = ((divList.children[2]).innerText);

    fillModalAula(idAviso);
}

btnEditar.forEach(button => {
    button.addEventListener('click', getData)
})


function fillModalAula(idAviso){
    $.ajax({
       url: url+"/app/Model/Ajax.php",    //the page containing php script
       type: "post",    //request type,
       dataType: 'json',
       data: {class: "AvisoProf", method: "listAvisosPorID", params: Array(idAviso)},
       success:function(result){
            $('#nome-aviso').val(result.nome);
            $('#descricao-aviso').val(result.descricao);
       }
   });
}
