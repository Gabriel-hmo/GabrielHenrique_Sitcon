$(document).ready(function () {
    console.log(procedimento);
    selectProcedimento(0);
});


function selectProcedimento(opt){
    let html = '';
    //consulta
    if(opt == 1){
        html += `<select name="procedimento" id="procedimento">
                    <option value = "0" selected> Selecione </option>`
        procedimento.forEach(element => {
            if(element[2]==opt){
                html +=`<option value = "`+ element[0] +`">`+ element[1]+`</option>`
            }
        });
        html += `</select>`
    }else if(opt == 2){
        procedimento.forEach(element => {
            if(element[2]==opt){
                html += "<div class='form-group form-check'>"
                html += "<input type='checkbox' value='"+element[0]+"' id='exame"+element[0]+"' name = 'exame[]'"
                html +="<label class='check-label' >"+ element[1] +"</label></div>"
            }
        });
    }else{
        html += `<select name="procedimento" id="procedimento">
                    <option value = "0" selected> Selecione </option>`
        procedimento.forEach(element => {
            html +=`<option value = "`+ element[0] +`">`+ element[1]+`</option>`
        });
        html += `</select>`
    }
    $("#divProcedimento").html("")
    $("#divProcedimento").html(html)
}


function salvar(){
    if(!verificarCampos()){
        return;
    }

    let dados = new FormData(document.getElementById('formSolicitacao'));
    let url = 'salvaSolicitacao.php'
    Swal.fire({
        text: "Você tem certeza que deseja prosseguir?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2196f3',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url : url,
                type : "POST",
                data : dados,
                dataType : "json",
                processData : false,
                contentType: false,
                success : function(response){
                    if (response.status) {
                        Swal.fire({
                            text: response.retorno,
                            icon: 'success',
                            confirmButtonColor: '#2196f3',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            // if( result.value ) {
                            //     window.location.href = 'index.php';
                            // }
                            })
                    } else {
                        Swal.fire({
                            text: response.retorno,
                            icon: 'error'
                        })
                    }

            },
            error: function(){}
            }); 
        }else if (result.dismiss === 'cancel') {
            return;
        }
    })
}

function verificarCampos(){
    return true;
}