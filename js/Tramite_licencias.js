

function TDate() {
    var UserDate = document.getElementById("userdate").value;
    var ToDate = new Date();
    console.log(ToDate.toISOString());
    if (new Date(UserDate).toISOString() <= ToDate.toISOString()) {
        alert("La fecha debe ser mayor a (actual): " + ToDate);
        return false;
    }
    return true;
};

function validarFechas() {
    const fechaInicio = new Date(document.getElementsByName('fecha_inicio')[0].value);
    const fechaFinal = new Date(document.getElementsByName('fecha_fin')[0].value);
    const fechaActual = new Date();
    if (fechaInicio < fechaActual || fechaFinal < fechaActual) {
        alert('Las fechas deben ser desde la fecha actual hacia adelante.');
        document.getElementsByName('fecha_inicio')[0].value = '';
        document.getElementsByName('fecha_fin')[0].value = '';
        return false;
    }

    if (fechaInicio > fechaFinal) {
        alert('La fecha de inicio debe ser anterior a la fecha final.');
        document.getElementsByName('fecha_ingreso')[0].value = '';
        document.getElementsByName('fecha_fin')[0].value = '';
        return false;
    }
    return true;
};



var estadoSelect = document.getElementById("estadoSelect");
var motivoJustificacion = document.getElementById("motivoJustificacion");

estadoSelect.addEventListener("change", function () {
    if (estadoSelect.value === "3") {
        motivoJustificacion.style.display = "block";
        document.querySelector('input[name="comentario"]').required = true;
    } else {
        motivoJustificacion.style.display = "none";
        document.querySelector('input[name="comentario"]').required = false;
    }
});
    // Comprobar el valor inicial al cargar la página
    if (estadoSelect.value === "3") {
        motivoJustificacion.style.display = "block";
        document.querySelector('input[name="comentario"]').required = true;
    }