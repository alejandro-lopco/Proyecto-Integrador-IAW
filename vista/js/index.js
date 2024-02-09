// Por cada opción creada se debe crear una funcion correspondiente
// Dicha función tiene que corresponder con las id únicas
// Si no se hace esto, se cambiara todo los elementos con el mismo ID
function abrirDeslizable1() {
    document.getElementById("tituloOpcion1").style.color = "white";
    document.getElementById("tituloOpcion1").style.transition = "500ms";
    document.getElementById("deslizableOpcion1").style.height = "500px";
    document.getElementById("deslizableOpcion1").style.transition = "500ms";
}
function cerrarDeslizable1() {
    document.getElementById("tituloOpcion1").style.color = "black";
    document.getElementById("tituloOpcion1").style.transition = "500ms";
    document.getElementById("deslizableOpcion1").style.height = "0px";
    document.getElementById("deslizableOpcion1").style.transition = "500ms";
}
