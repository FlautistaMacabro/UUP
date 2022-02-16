let btnDelete = document.querySelectorAll(".btn-delete");
let inputIDAviso = document.getElementsByName("id-aviso-delete")[0];
let AvisoDelNome = document.getElementById("aviso-delete-name");


function insertAvisoName(event) {
    let divList = ((event.currentTarget).parentNode).parentNode;
    let nomeAviso = ((divList.firstElementChild).firstElementChild).innerText;
    let idAviso = ((divList.children[2]).innerText);

    inputIDAviso.value = idAviso;
    AvisoDelNome.innerText = nomeAviso;
}


btnDelete.forEach(button => {
    button.addEventListener('click', insertAvisoName)
})



let btnEditar = document.querySelectorAll(".btn-editar");
let url = (document.getElementsByTagName("base")[0]).href;

function getData(event) {
    let divList = ((event.currentTarget).parentNode).parentNode;
    let idAviso = ((divList.children[2]).innerText);

    fillModal(idAviso);
}

btnEditar.forEach(button => {
    button.addEventListener('click', getData)
})


function fillModal(idAviso){
    $.ajax({
       url: url+"/app/Model/Ajax.php",    //the page containing php script
       type: "post",    //request type,
       dataType: 'json',
       data: {class: "Aviso", method: "infoAvisoGlobal", params: Array(idAviso)},
       success:function(result){
            $('#id-aviso-atual').val(result.id_avisoGlobal);
            $('#nome-aviso').val(result.nome);
            $('#descricao-aviso').val(result.descricao);
       }
   });
}
