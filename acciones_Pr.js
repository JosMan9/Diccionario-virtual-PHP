var inputsArray = new Array();
var areaArray = new Array();

function cargar(dato) {

    dato_A = Object.keys(dato);

    dato_B = new Array();
    var padre = document.getElementById("contenedor_padre");
    var longitud = dato_A.length;

    for (var i = 0; i < longitud; i++) {
        dato_B[i] = dato[dato_A[i]];
    }

    for (var i = 0; i < longitud; i++) {
        inputsArray[i] = document.createElement("input");
        inputsArray[i].setAttribute("value", dato_A[i]);
        inputsArray[i].setAttribute("readonly", "readonly");
        inputsArray[i].setAttribute("style", "width: 990px");
        inputsArray[i].setAttribute("class", 'input_R');
    
        areaArray[i] = document.createElement("textarea");
        areaArray[i].value = dato_B[i];
        areaArray[i].setAttribute("readonly", "readonly");
        areaArray[i].setAttribute("style", "resize: none");
        areaArray[i].setAttribute("cols", "116");
        areaArray[i].setAttribute("rows", "10");
        areaArray[i].setAttribute('class', 'area_R');
    }
    padre.appendChild(document.createElement("p"));
    for (var i = 0; i < longitud; i++) {
        padre.appendChild(inputsArray[i]);
        padre.appendChild(document.createElement("br"));
        padre.appendChild(areaArray[i]);
        padre.appendChild(document.createElement("p"));
    }
}


function validarDatos() {
    var input_palabra = document.getElementById("palabra_agregar");
    var text_definicion = document.getElementById("definicion_agregar");
    var boton = document.getElementById("boton_enviar");

    var validacion = true;

    if (input_palabra.value != "" && text_definicion.value != "") {
        validacion = false;
    }

    boton.disabled = validacion;
}

function validarDato() {
    var input_eliminar = document.getElementById("palabra_eliminar");
    var btn = document.getElementById('btn_eliminar');

    var validacion = true;

    if (input_eliminar.value != "") {
        validacion = false;
    }

    btn.disabled = validacion;
}

function cancelar() {
    var key = event.keyCode;

    if (key === 13) {
        event.preventDefault();
    }
}