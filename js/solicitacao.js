$(document).ready(function () {
    console.log(procedimento);
    selectProcedimento(0);
});


function selectProcedimento(opt){
    let html = '';
    //consulta
    if(opt == 1){
        html += `<select class="form-select" name="procedimento" id="procedimento">
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
        html += `<select class="form-select" name="procedimento" id="procedimento">
                    <option value = "0" selected> Selecione </option>`
        procedimento.forEach(element => {
            html +=`<option value = "`+ element[0] +`">`+ element[1]+`</option>`
        });
        html += `</select>`
    }
    $("#divProcedimento").html("")
    $("#divProcedimento").html(html)
}

// function enviarForm(){
//     let data
//     $.ajax({
//         url: 'listaSolicitacao.php',
//         type: 'POST', // ou 'POST', 'PUT', etc., dependendo do que você precisa
//         dataType: 'json', // o tipo de dados que você espera receber
//         success: function(data) {
//             // A função de sucesso é chamada quando a requisição é bem-sucedida
//             console.log(data); // Aqui você pode manipular os dados recebidos
//         },
//         error: function(xhr, status, error) {
//             // A função de erro é chamada se houver algum problema na requisição
//             console.error(xhr.responseText);
//         }
//     });
// }

// function salvar(){
//     // if(!verificarCampos()){
//     //     return;
//     // }

//     let dados = new FormData(document.getElementById('formSolicitacao'));
//     let url = 'salvaSolicitacao.php'
//     console.log('chamou1');
//     $.ajax({
        
//         url : url,
//         type : "POST",
//         data : dados,
//         dataType : "json",
//         processData : false,
//         contentType: false,
//         success: function(response) {
//             console.log(response);
//             // Função de sucesso, chamada quando a requisição é bem-sucedida
//             if(response.status){
//                 console.log('chamou3');
                
//                 window.alert("Requisição bem-sucedida: " + response.retorno);
//                 // window.location.href = 'index.php';
//             }else{
//                 console.log('chamou2');
//                 window.alert("Erro na requisição: " + response.retorno);
//                 // window.location.href = 'index.php';
//             }

//         },
//         error: function(xhr, status, error) {
//             // Este código é executado se ocorrer um erro durante a requisição
//             console.error("Erro na requisição:", error);
//             window.alert("Erro na requisição:", error);
//             // window.location.href = 'index.php';
//         }
//     });
       
// }

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
                    console.log("foi sim");
                    if (response.status) {
                        console.log("foi sim1")
                        Swal.fire({
                            text: response.retorno,
                            icon: 'success',
                            confirmButtonColor: '#2196f3',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if( result.value ) {
                                // window.location.href = 'index.php';
                            }
                            })
                        window.location.href = 'index.php';
                    } else {
                        console.log("foi sim2")
                        Swal.fire({
                            text: response.retorno,
                            icon: 'error'
                        })
                        window.location.href = 'index.php';
                    }

            },
            error: function(xhr, status, error) {
                // Este código é executado se ocorrer um erro durante a requisição
                console.log("foi nao")
                console.error("Erro na requisição:", error);
                window.location.href = 'index.php';
            }
            // error: function(){
            // }
            }); 
        }else if (result.dismiss === 'cancel') {
            return;
        }
    })
}

function verificarCampos(){
    return true;
}