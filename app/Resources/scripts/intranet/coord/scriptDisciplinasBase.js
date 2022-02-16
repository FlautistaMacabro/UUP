let btnDelete = document.querySelectorAll(".btn-delete");
let inputNomeDisciplina = document.getElementsByName("nome-disciplina-delete")[0];
let disciplinaDelNome = document.getElementById("disciplina-delete-name");


function insertDisciplinaName(event) {
    let divList = ((event.currentTarget).parentNode).parentNode;
    let nomeDisciplina = ((divList.firstElementChild).firstElementChild).innerText;

    inputNomeDisciplina.value = nomeDisciplina;
    disciplinaDelNome.innerText = nomeDisciplina;
}


btnDelete.forEach(button => {
    button.addEventListener('click', insertDisciplinaName)
})



let btnEditar = document.querySelectorAll(".btn-editar");
let url = (document.getElementsByTagName("base")[0]).href;

function getData(event) {
    let divList = ((event.currentTarget).parentNode).parentNode;
    let nomeDisciplinaBase = ((divList.firstElementChild).firstElementChild).innerText;

    fillModal(nomeDisciplinaBase);
}

btnEditar.forEach(button => {
    button.addEventListener('click', getData)
})


function fillModal(nomeDisciplinaBase){
    $.ajax({
       url: url+"/app/Model/Ajax.php",    //the page containing php script
       type: "post",    //request type,
       dataType: 'json',
       data: {class: "DisciplinaBase", method: "infoDiscBase", params: Array(nomeDisciplinaBase)},
       success:function(result){
            $('#nome-discbase').val(result.nome_disc);
            $('#nome-discbase-atual').val(result.nome_disc);
            $('#carga-horaria').val(result.carga_horaria);
            $('#qtd-aulas-previstas').val(result.qtd_aulas_previstas);
            $('#semestre-dado').val(result.semestre_dado);
            $('#ano-min').val(result.ano_min);
       }
   });
}
