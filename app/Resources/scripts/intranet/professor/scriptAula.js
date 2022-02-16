let prox = document.getElementById("first-page");
let prev = document.getElementById("sec-page");

function displayTable(event) {
    let div = document.getElementById('form-data');
    div.style.display = "none";

    let divTable = document.getElementById('presenca');
    divTable.style.display = "block";

    prox.style.display = "none";
    prev.style.display = "block";
}

function hideTable(event) {
    let divTable = document.getElementById('presenca');
    divTable.style.display = "none";

    let div = document.getElementById('form-data');
    div.style.display = "block";

    prox.style.display = "block";
    prev.style.display = "none";
}

prox.addEventListener('click', displayTable);
prev.addEventListener('click', hideTable);





let btnDelete = document.querySelectorAll(".btn-delete");
let inputIDAula = document.getElementsByName("id-aula-delete")[0];
let AulaDelNome = document.getElementById("aula-delete-name");


function insertAulaName(event) {
    let divList = ((event.currentTarget).parentNode).parentNode;
    let nomeAula = ((divList.firstElementChild).firstElementChild).innerText;
    let idAula = ((divList.children[2]).innerText);

    inputIDAula.value = idAula;
    AulaDelNome.innerText = nomeAula;
}


btnDelete.forEach(button => {
    button.addEventListener('click', insertAulaName)
})







let btnEditar = document.querySelectorAll(".btn-editar");
let url = (document.getElementsByTagName("base")[0]).href;

function getData(event) {
    let divList = ((event.currentTarget).parentNode).parentNode;
    let idAula = ((divList.children[2]).innerText);

    fillModalAula(idAula);
    fillPresenca(idAula);
}

btnEditar.forEach(button => {
    button.addEventListener('click', getData)
})


function fillModalAula(idAula){
    $.ajax({
       url: url+"/app/Model/Ajax.php",    //the page containing php script
       type: "post",    //request type,
       dataType: 'json',
       data: {class: "Aula", method: "listarDadosAulaPorID", params: Array(idAula)},
       success:function(result){
            $('#id-aula-atual').val(result.id_aula);
            $('#nome-aula').val(result.nome);
            $('#hora-aula').val(result.dataHora);
            $('#data-aula').val(result.dataAula);
            $('#descricao-aula').val(result.descricao);
       }
   });
}


function fillPresenca(idAula){
    $.ajax({
       url: url+"/app/Model/Ajax.php",    //the page containing php script
       type: "post",    //request type,
       dataType: 'json',
       data: {class: "Aula", method: "listarDadosdeFreqPorIDAula", params: Array(idAula)},
       success:function(result){

        let items = '';

        for (let i = 0; i < result.length; i++) {
            items += '<tr> <td class="has-text-centered" style="white-space: nowrap;"> <input type="checkbox" name="presenca_list[]" value="'+result[i].nomeAluno+'" '+((result[i].presenca) ? "checked" : "")+'> </td> <td class="has-text-centered" style="white-space: nowrap;">'+result[i].nomeAluno+'</td> </tr>';
        }

       $('#itemsTabela').html(items);
       }
   });
}




let prox_editar = document.getElementById("first-page-editar");
let prev_editar = document.getElementById("sec-page-editar");

function displayTableEditar(event) {
    let div = document.getElementById('form-data-editar');
    div.style.display = "none";

    let divTable = document.getElementById('presenca-editar');
    divTable.style.display = "block";

    prox_editar.style.display = "none";
    prev_editar.style.display = "block";
}

function hideTableEditar(event) {
    let divTable = document.getElementById('presenca-editar');
    divTable.style.display = "none";

    let div = document.getElementById('form-data-editar');
    div.style.display = "block";

    prox_editar.style.display = "block";
    prev_editar.style.display = "none";
}

prox_editar.addEventListener('click', displayTableEditar);
prev_editar.addEventListener('click', hideTableEditar);
