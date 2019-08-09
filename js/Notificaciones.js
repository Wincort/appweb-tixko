let MostrarNotifiacion = (dataObject) => {
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
}