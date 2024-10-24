$(document).ready(function () {    


    $('#pdfCaja').click(function (e) {
        e.preventDefault();
        let id = $('#pdfCaja').attr('data-id');


        
         $.get('/cajas/pdf/' + id,
            function (data, textStatus, jqXHR) {
                    if(data){
                        $("#lectorPdf").attr('src', documentUrl + data)
                    }        
            }   
        );


    });


    $('#botonMovimientoIngreso').click(function (e) {
        e.preventDefault();        
        let cajaId = $(this).attr('data-id');
        let urlCajaIngreso = url + 'cajamovimiento/create/' + cajaId + '/' + 'I';
        $("#agregarMovimientoIngreso").attr('src', urlCajaIngreso )        
    }); 


    $(".buttonDisponibilizar").click(function(e){        
        const url = $(this).attr('data-url');
        $("#cajaIdModal").val($(this).attr('data-id'));
        $("#formDisponibilizar").attr("action",url);        
      
    });

    $("#aceptarDisponibilizar").on("click",function(e){
        $('#formDisponibilizar').trigger("submit");
        e.preventDefault();
    });
    

    $(document).on('submit', '#formDisponibilizar', function (evt) {        
        $.post( $('#formDisponibilizar').attr("action") + '/' + $("#cajaIdModal").val() ,  $('#formDisponibilizar').serialize() ,
            function (result) {
                result = JSON.parse(result)
                               
                if(result.ok == 'error'){
                    mensaje("error",result.mensaje)                    
                }else{
                    mensaje("success",result.mensaje)                                                                       
                }   
                setTimeout(closeMensaje,5000)               
            }
        );
        evt.preventDefault();
    });

    function mensaje(tipoMensaje,mensaje){    
        $(".descripcionAlert").empty();
        switch (tipoMensaje) {
            case "success":            
                $("#mensajeAlert").addClass('alert-success');
                $(".descripcionAlert").append( "<i class='far fa-check-circle'></i> " + mensaje);
                break;
        
            case "error":
                $("#mensajeAlert").addClass('alert-danger');
                $(".descripcionAlert").append( "<i class='fas fa-times'></i> " + mensaje);
                break;
    
            case "info":
                $("#mensajeAlert").addClass('alert-primary');
                $(".descripcionAlert").append("<i class='fas fa-info'></i>> " + mensaje);
                break;
        }        
        $("#mensajeAlert").removeClass('invisible');
        
    }
   
    function closeMensaje(){
        $("#mensajeAlert").addClass('invisible');
        $("#descripcionAlert").empty();
    }


});