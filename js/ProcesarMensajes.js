let ValidarFormulario = () => {
    let campos_faltantes = 0;
    $('.requerido').each(function() {
        if ($(this).val() == 0 || $(this).val() == '' || $(this).val() == null) {
            $(this).css({ 'border': '0.5rem solid #F00' });
            $(this).focus();
            setTimeout(() => { $(this).focus(); }, 100);
            campos_faltantes++;
            return false;
        } else {
            $(this).css({ 'border': '0.1rem solid #B5D6A9' });
            campos_faltantes = 0;
        }
    });

    if (campos_faltantes > 0) {
        let statusObject = {
            status: false,
            titulo: "¡Falta campo requerido!",
            mensaje: "Por favor añada información al campo requerido"
        };
        MostrarNotifiacion(statusObject);
        return false;
    }
    PrepararMensaje();
}

let PrepararMensaje = () => {
    dataForm = new FormData(document.getElementById('formulario'));
    EnviarMensaje(dataForm)
        .then(data => {
            MostrarNotifiacion(data);
            $('#formulario').each(function() { this.reset(); });
        })
        .catch(err => console.error(err));
}

let EnviarMensaje = async(parametros) => {
    let response = await fetch(`admin/operaciones/ProcesarDatos.php?${parametros}`, {
        method: "POST",
        body: parametros
    });
    let data = await response.json();
    return data;
}

/*let MostrarNotifiacion = (dataObject) => {
    let { status, titulo, mensaje } = dataObject;
    let ColorNotificacion = status == true ? "#327522" : "#FF0000";
    //Configuración de la notificación usando Metro-Notifications
    $.smallBox({
        title: `<br>${titulo}<br>`,
        content: `<br>${mensaje}<br><br>`,
        sound: true,
        soundpath: "lib/metro-notifications/static/sound/",
        color: ColorNotificacion,
        timeout: 3000,
    });
}*/

/*function EnviarCorreo(TipoEmail) {
    var correo = $("#correo").val();
    var dataString = $('#formulario').serialize();

    let UrlEmail = TipoEmail ? "admin/correos/correo.aviso.php" : "admin/correos/correo.respuesta.php";
    if (correo != '') {
        $.ajax({
            url: UrlEmail,
            type: "POST",
            cache: true,
            async: true,
            data: dataString,
            dataType: 'json'
        });
    }
}*/