function ajaxCall(url, postData, callback) {
    options = {
        url: url,
        type: 'get',
        success: function (data) {
            try {
                $(".loader").hide();
                rta = $.parseJSON(data);
                if (rta.errores.length) {
                    showErroresJson(rta.errores);
                }
                if (rta.aviso) {
                    showSuccess(rta.aviso);
                }
                if (rta.info) {
                    showNotice(rta.info);
                }
                if (callback) {
                    callback(rta);
                }
            } catch (e) {
                console.log(e);
                showError(e);
            }
        }
    };

    if (postData) {
        options["data"] = postData;
        options["type"] = 'post';
    }

    console.log(options);

    return ajaxManager.add(options);
}


function showSuccess(msj) {
     $().toastmessage('showSuccessToast', msj);
}

function showNotice(msj) {
     $().toastmessage('showNoticeToast', msj);
}


function showError(msj) {
    $().toastmessage('showErrorToast', msj);
}

function showErroresJson(errores) {
    salid = '<ul>';
    $.each(errores, function (p, err) {
        salid += '<li>' + err + '</li>';
        console.log("Error:" + err);
    });
    salid += '<ul>';

    // showError(salid);
}

