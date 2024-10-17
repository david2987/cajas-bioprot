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

});