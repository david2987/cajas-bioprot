const mensajeAlert = function(tipoMensaje,mensaje){    
    $("#descripcionAlert").empty();
    switch (tipoMensaje) {
        case "success":            
        $("#mensajeAlert").addClass(className);('alertalert-success');    
        $("#descripcionAlert").append( "<i class='far fa-check-circle'></i> " + mensaje);
            break;
    
        case "error":
            $("#mensajeAlert").addClass(className);('alertalert-danger');    
            $("#descripcionAlert").append( "<i class='far fa-check-times'></i> " + mensaje);
            break;

        case "info":
            $("#mensajeAlert").addClass(className);('alertalert-primary');    
            $("#descripcionAlert").append("<i class='far fa-check-info'></i> " + mensaje);
            break;
    }
    $("#mensajeAlert").removeClass('invisible');
}

export default mensajeAlert;