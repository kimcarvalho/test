//JQUERY IN USE -----------------------------------------------------------------------------------------------------------------
$(document).ready(function(){
    $('#msg, #msg-status').hide();
    $('.fa-trash-alt').css("color", "red");

    //Render the datatable with words in portuguese
    $('#clients').dataTable({
            "bJQueryUI": true,
            "oLanguage": {
                "sProcessing":   "Processando...",
                "sLengthMenu":   "Mostrar _MENU_ registros",
                "sZeroRecords":  "Não foram encontrados resultados",
                "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                "sInfoFiltered": "",
                "sInfoPostFix":  "",
                "sSearch":       "Buscar:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext":     "Seguinte",
                    "sLast":     "Último"
                }
            }                     
    });
    
    //Insert a new input of telephone (OnClick / Touch - Event)
    $('.novo-tel').on('click', function(){
        var div = $('#div-tel');

        div.append(            
            "<p>"+
                "<div class='input-group mb-3'>"+
                    "<div class='input-group-prepend'>"+
                        "<span class='input-group-text'>Tel</span>"+
                    "</div>"+
                    
                    "<input type='text' class='form-control' name='tel[]' required>"+
                    
                    "<div class='input-group-append'>"+
                        "<span class='input-group-text close-tel btn'><b>x</b></span>"+
                    "</div>"+
                "</div>"+
            "</p>"
        );
    });

    $(document).on('click', '.close-tel', function(){        
        $(this).parent().parent().remove();
    });    


    //Insert a new input of e-mail (OnClick / Touch - Event)
    $('.novo-email').on('click', function(){
        var div = $('#div-email');

        div.append(            
            "<p>"+
                "<div class='input-group mb-3'>"+
                    "<div class='input-group-prepend'>"+
                        "<span class='input-group-text'>E-mail</span>"+
                    "</div>"+
                    
                    "<input type='text' class='form-control' name='email[]' required>"+
                    
                    "<div class='input-group-append'>"+
                        "<span class='input-group-text close-tel btn'><b>x</b></span>"+
                    "</div>"+
                "</div>"+
            "</p>"
        );
    });
  
    //POST SUBMIT FORM TO INSERT A NEW CLIENT
    $('#cliente').on("submit", function(e){
        e.preventDefault();

        $('.btn-sub').hide();
        var form = $( this );
        dados = form.serialize();       
            
        $.ajax({
            type : "POST",
            url : "cadastrar-cliente",           
            dataType: 'json',
            data : dados,
            success : function(){
               $('#msg').show().delay(4000).fadeOut(function(){
                   $(location).attr('href','/clientes')
               });
            }
        });        
    });

    //UPDATE STATUS ON CLICK / TOUCH
    $(".chk").on("click", function(){
        var status = 0;
        cliente = $(this).val();

        if($(this).prop("checked") == true){
            status = 1;
            $('#cli'+cliente).text("Ativo");
            $('#cli'+cliente).css('color', 'green');
        }else{
            status = 0;
            $('#cli'+cliente).text("Inativo");
            $('#cli'+cliente).css('color', 'red');
        }
        
        $.ajax({
            type : "POST",
            url : "atualizar-cliente/"+cliente,           
            dataType: 'json', 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },           
            data : {                         
                "cliente" : cliente,
                "status" : status
            },            
            success : function(){
               $('#msg-status').show().delay(4000).fadeOut();               
            }
        });
    });

    $(".update").on("change", function(){
        form = $(this).parents("form");
        var url = form.attr('action');
        var input = $(this);        
        
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                input.addClass("border-success");
            }
        });

    });

}); // the end

//Function for delete any amail or telphone of the client (Event - On Click)
function destroy(type, id){    
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        type: "POST",
        url: "/clientes/"+id,
        data: {
            "type" : type,
            "id" : id,
            "_token" : token
        }, 
        success: function(data)
        {
            location.reload();          
        }
    });
}
