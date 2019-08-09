let validaMail = (valor, campo) => {
    let text = valor.toLowerCase();
    if (text == '') return true;
    if (/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/.test(text)) {
        return true;
    } else {
        $(`#${campo}`).val('');
        setTimeout(() => { $(`#${campo}`).focus(); }, 100);
        let errorObject = {
            status: false,
            titulo: "¡Información Inválida!",
            mensaje: "El correo electrónico no es válido"
        };
        MostrarNotifiacion(errorObject);
        return false;
    }
}

let validaLongitud = (campo, lon) => {
    let val = $(`#${campo}`).val();
    if (val.length > 0 && lon != val.length) {
        $(`#${campo}`).val('');
        setTimeout(() => { $(`#${campo}`).focus(); }, 100);
        let errorObject = {
            status: false,
            titulo: "¡Información Inválida!",
            mensaje: "El número telefónico debe ser de 10 dígitos"
        };
        MostrarNotifiacion(errorObject);
        return false;
    }
}

let isNumberKey = (evt) => {
    let e = evt || window.event; // for trans-browser compatibility
    let charCode = e.which || e.keyCode;
    if (charCode > 31 && (charCode < 47 || charCode > 57)) return false;
    if (e.shiftKey) return false;
    return true;
}