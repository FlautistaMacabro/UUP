let btnDelete = document.querySelectorAll(".btn-delete");
let inputNomeCurso = document.getElementsByName("nome-curso-delete")[0];
let cursoDelNome = document.getElementById("curso-delete-name");


function insertCursoName(event) {
    let divList = ((event.currentTarget).parentNode).parentNode;
    let nomeCurso = ((divList.firstElementChild).firstElementChild).innerText;

    inputNomeCurso.value = nomeCurso;
    cursoDelNome.innerText = nomeCurso;
}


btnDelete.forEach(button => {
    button.addEventListener('click', insertCursoName)
})



let btnEditar = document.querySelectorAll(".btn-editar");
let url = (document.getElementsByTagName("base")[0]).href;

function getData(event) {
    let divList = ((event.currentTarget).parentNode).parentNode;
    let nomeCurso = ((divList.firstElementChild).firstElementChild).innerText;

    fillModal(nomeCurso);
    fillModalCoord(nomeCurso);
}

btnEditar.forEach(button => {
    button.addEventListener('click', getData)
})


function fillModal(nomeCurso){
    $.ajax({
       url: url+"/app/Model/Ajax.php",    //the page containing php script
       type: "post",    //request type,
       dataType: 'json',
       data: {class: "Curso", method: "infoCurso", params: Array(nomeCurso)},
       success:function(result){
            $('#cursoNome').val(result.nome);
            $('#nome-curso-atual').val(result.nome);
            $('#cursoTipo').val(result.tipo);
            $('#minAnos').val(result.minAnos);
            $('#maxAnos').val(result.maxAnos);
       }
   });
}

function fillModalCoord(nomeCurso){
    $.ajax({
       url: url+"/app/Model/Ajax.php",    //the page containing php script
       type: "post",    //request type,
       dataType: 'json',
       data: {class: "Curso", method: "nomeCoordenadores", params: Array(nomeCurso)},
       success:function(result){
            if(result.length < 1) $('#nomeCoords').val("=>Nenhum coordenador vínculado");
            else
            {
                let nomes = "";
                for (let i = 0; i < result.length; i++) {
                    nomes += ((result[i]).nome + "\n");
                }
                $('#nomeCoords').val(nomes);
            }
       }
   });
}