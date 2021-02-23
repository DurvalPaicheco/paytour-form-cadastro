$(document).ready(function(){
    $('#curriculo').bind('change', function() {
        if(this.files[0].size/1024/1024 > 1){
            alert('Tamanho máximo de 1MB, por favor insira um arquivo menor.');
            $("#curriculo").val("");
        }
    });

    
});


function validaForm(){
    
    if($('#nome').val() == '' ){
        return 'nome';
    }
    if($('#email').val() == '' ){
        return 'email';
    }
    if($('#telefone').val() == '' ){
        return 'telefone';
    }
    if($('#cargo').val() == '' ){
        return 'cargo';
    }
    if($('#escolaridade').val() == '' ){
        return 'escolaridade';
    }
    
    if($('#curriculo').val() == '' ){
        return 'curriculo';
    }

    return true;
}

function submitForm(){
    var resp = validaForm();
    if(resp != true ){
        $("#modal-conteudo").html('O campo '+resp+' é obrigatorio. Por favor preencha e tente novamente.');
        $("#modAlert").show();
        
        return;
    }

    var formData = new FormData();
    var file = $("#curriculo")[0].files;
    formData.append('curriculo',file[0]);

    var ext = $('#curriculo').val().split('.').pop().toLowerCase();
    
    if($.inArray(ext, ['','doc','docx','pdf']) == -1) {
        
        $("#modal-conteudo").html('Formato inválido! Por favor utilize os sequintes formatos : "<span class="spanDanger">.doc</span>", "<span class="spanDanger">.docx</span>" ou "<span class="spanDanger">.pdf</span>"');
        $("#modAlert").show();
        return;
    }
    
    formData.append('nome',$("#nome").val());
    formData.append('telefone',$("#telefone").val());
    formData.append('email',$("#email").val());
    formData.append('obs',$("#obs").val());
    formData.append('cargo',$("#cargo").val());
    formData.append('escolaridade',$("#escolaridade").val());


    $.ajax({
       
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/curriculo/savCurriculo',
        data: formData,
        contentType: false,
        processData: false, 
        cache: false,
        type: 'POST',
        dataType: 'json', 
        success: function(data){
            if(data){
                if(data == 1){
                    $('#enivar').attr('disabled', 'disabled');
                    alert('Curriculo cadastrado com sucesso! Obrigado, logo seu curriculo será avaliado e entraremos em contato.');
                    
                }else{
                    alert(data);
                    
                }
            }
        },
        error:function(){

        }
    });


}

function closeModal(){
    $("#modAlert").hide();
}


