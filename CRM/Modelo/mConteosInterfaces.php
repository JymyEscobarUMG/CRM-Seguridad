<?php
// IMPORTANDO ARCHIVO DE CONEXION
require 'conexion.php';

// Función genérica para obtener conteos
function obtenerConteo($cnn, $spName) {
    $stmt = $cnn->prepare("CALL $spName()");
    $stmt->execute();
    $resultado = $stmt->get_result();
    $conteo = $resultado->num_rows > 0 ? $resultado->num_rows : 0;
    $stmt->close();
    return $conteo;
}

/*
    --> VALIDO INDEX -> USUARIOS ADMINISTRADORES
*/
function NumeroAdministradoresRegistrados($cnn1) {
    return obtenerConteo($cnn1, "ConsultaUsuariosAdministradores");
}

function NumeroEmpleadosRegistrados($cnn2) {
    return obtenerConteo($cnn2, "ConsultarUsuariosGenerales");
}

function NumeroReportesPlataformaRegistrados($cnn3) {
    return obtenerConteo($cnn3, "ConsultarReportesPlataforma");
}

function NumeroCasosClientesRegistrados($cnn4) {
    return obtenerConteo($cnn4, "ConsultarReportesReclamosClientes");
}

/*
    --> VALIDO INDEX -> USUARIOS EMPLEADOS
*/
function NumeroCasosClientesActivosRegistrados($cnn5) {
    return obtenerConteo($cnn5, "ConteoCasosActivosEmpleados");
}

function NumeroCasosClientesPendientesRegistrados($cnn6) {
    return obtenerConteo($cnn6, "ConteoCasosPendientesEmpleados");
}

function NumeroClientesRegistrados($cnn7) {
    return obtenerConteo($cnn7, "ConteoClientesRegistrados");
}

function NumeroProductosRegistrados($cnn8) {
    return obtenerConteo($cnn8, "ConteoProductosRegistrados");
}
?>
