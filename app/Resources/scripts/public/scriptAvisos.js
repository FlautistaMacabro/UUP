let items = document.querySelectorAll(".item-avisos");

function hoverColorOver(event) {
    let row = event.currentTarget;

    row.style.fontWeight = "bold";
    row.style.color = "hsl(271, 100%, 71%)";
}

function hoverColorOut(event) {
    let row = event.currentTarget;

    row.style.fontWeight = "normal";
    row.style.color = "black";

}


items.forEach(item => {
    item.addEventListener('mouseover', hoverColorOver)
    item.addEventListener('mouseout', hoverColorOut)
})



let url = (document.getElementsByTagName("base")[0]).href;

function getData(event) {
    let rowId = ((event.currentTarget).children[0]);
    let rowGroup = ((event.currentTarget).children[1]);

    fillModal(rowId.innerText, rowGroup.innerText);
}

items.forEach(item => {
    item.addEventListener('click', getData)
})


function fillModal(idAviso, grupo){
    $.ajax({
       url: url+"/app/Model/Ajax.php",    //the page containing php script
       type: "post",    //request type,
       dataType: 'json',
       data: {class: "Aviso", method: "getAvisosInfo", params: Array(idAviso, grupo)},
       success:function(result){
            $('#assunto').val(result.assunto);
            $('#descricao').val(result.descricao);
       }
   });
}
