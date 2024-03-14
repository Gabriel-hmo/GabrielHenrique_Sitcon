
// let table = new DataTable('#table');

var table = new DataTable('#table', {
    language: {
        url: '//cdn.datatables.net/plug-ins/2.0.2/i18n/pt-BR.json',
    },
});

function enviarDados(linha){
    let form = $('<form action="solicitacao.php" method="post" class="fadeInUpShort"></form>');
    addFormulario(form, 'id', $('#idPaciente'+linha).val());
    addFormulario(form, 'nome', $('#pNome'+linha).html());
    addFormulario(form, 'data', $('#pDtnasc'+linha).html());
    addFormulario(form, 'CPF', $('#pCPF'+linha).html());
    $('body').append(form);
    form.submit();
    
}

function addFormulario(form, inputName, inputValue) {
    $('<input>').attr({
        type: 'hidden',
        name: inputName,
        value: inputValue
    }).appendTo(form);
}

// $('#prosseguir').on('click', function(){
    


// })