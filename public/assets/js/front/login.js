
$("#loginBoton").click(function () {
    $("#loginForm").trigger("submit");
});

$("#loginForm").submit(function (e) {
    login(this)
    e.preventDefault();
});

function login(formu) {    

    let form = $( formu ).serializeArray()

    try {
        $.post(rutaLogin, form ,function (data) {
            if (data.ok) {
                showSuccess('Ingresando al Sistema')
            } else {
                showError("Error: " + data.mensaje)
            }
        });
    } catch (error) {
        showError("Error:" + error)
    }
}

