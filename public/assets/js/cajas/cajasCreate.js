$(document).ready(function () {
    var modal = document.getElementById("modalImagenes");

    $("#addImagenes").click(function (e) {         
        modal.showModal();        
        e.preventDefault();
            
    });

    $("#closeModal").click( ()=> {
        modal.close(); 
    });

    $(".cerrar").click( ()=> {
        modal.close(); 
    });

});