<?php
class ReportesClientes {
    // VARIABLES DE GESTION
    private $Id_Reporte;
    private $Id_ClienteReporte;
    private $Nombre_ClienteReporte;
    private $Nombre_EmpleadoRegistro;
    private $Nombre_EmpleadoGestionando;
    private $Producto_Reporte;
    private $Marca_Reporte;
    private $Fecha_RegistrosCasosClientes;
    private $Fecha_UltimaActualizacionCasosClientes;
    private $Detalle_ClienteReporte;
    private $Urgencia_Reporte;
    private $Estado_ClienteReporte;
    private $Comentarios_CasosClientesGestiones;

    // GETTERS & SETTERS (Mantienen la misma estructura original)
    public function setIDReporteria($n){ $this->Id_Reporte = $n; }
    public function getIDReporteria(){ return $this->Id_Reporte; }

    public function setIDClienteReporteria($n){ $this->Id_ClienteReporte = $n; }
    public function getIDClienteReporteria(){ return $this->Id_ClienteReporte; }

    public function setNombreClienteReporteria($n){ $this->Nombre_ClienteReporte = $n; }
    public function getNombreClienteReporteria(){ return $this->Nombre_ClienteReporte; }

    public function setNombreEmpleadoRegistroReporteria($n){ $this->Nombre_EmpleadoRegistro = $n; }
    public function getNombreEmpleadoRegistroReporteria(){ return $this->Nombre_EmpleadoRegistro; }

    public function setNombreEmpleadoGestionandoReporteria($n){ $this->Nombre_EmpleadoGestionando = $n; }
    public function getNombreEmpleadoGestionandoReporteria(){ return $this->Nombre_EmpleadoGestionando; }

    public function setProductoReporteria($n){ $this->Producto_Reporte = $n; }
    public function getProductoReporteria(){ return $this->Producto_Reporte; }

    public function setMarcaProductoReporteria($n){ $this->Marca_Reporte = $n; }
    public function getMarcaProductoReporteria(){ return $this->Marca_Reporte; }

    public function setFechaRegistroReporteria($n){ $this->Fecha_RegistrosCasosClientes = $n; }
    public function getFechaRegistroReporteria(){ return $this->Fecha_RegistrosCasosClientes; }

    public function setFechaActualizacionReporteria($n){ $this->Fecha_UltimaActualizacionCasosClientes = $n; }
    public function getFechaActualizacionReporteria(){ return $this->Fecha_UltimaActualizacionCasosClientes; }

    public function setDetalleReporteria($n){ $this->Detalle_ClienteReporte = $n; }
    public function getDetalleReporteria(){ return $this->Detalle_ClienteReporte; }

    public function setUrgenciaReporteria($n){ $this->Urgencia_Reporte = $n; }
    public function getUrgenciaReporteria(){ return $this->Urgencia_Reporte; }

    public function setEstadoReporteria($n){ $this->Estado_ClienteReporte = $n; }
    public function getEstadoReporteria(){ return $this->Estado_ClienteReporte; }

    public function setComentariosGestiones($n){ $this->Comentarios_CasosClientesGestiones = $n; }
    public function getComentariosGestiones(){ return $this->Comentarios_CasosClientesGestiones; }

    // CONSULTAR UN REPORTE ESPECÍFICO
    public function ConsultarUnReportePlataforma($cnn, $ID_CasosClientes) {
        $stmt = $cnn->prepare("CALL ConsultaEspecificaCasosClientes(?)");
        $stmt->bind_param("i", $ID_CasosClientes);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setIDClienteReporteria($Usuarios['Id_cliente']);
            $this->setNombreClienteReporteria($Usuarios['Nombre_cliente']);
            $this->setNombreEmpleadoRegistroReporteria($Usuarios['nombre_empleado_registro']);
            $this->setNombreEmpleadoGestionandoReporteria($Usuarios['nombre_empleado_gestionando']);
            $this->setProductoReporteria($Usuarios['Producto']);
            $this->setMarcaProductoReporteria($Usuarios['Marca']);
            $this->setFechaRegistroReporteria($Usuarios['Fecha_Registro_Caso']);
            $this->setFechaActualizacionReporteria($Usuarios['Ultima_Actualizacion_Caso']);
            $this->setDetalleReporteria($Usuarios['Detalle_de_problema']);
            $this->setUrgenciaReporteria($Usuarios['Urgencia']);
            $this->setEstadoReporteria($Usuarios['Estado_de_reporte']);
            $this->setComentariosGestiones($Usuarios['Comentarios_EmpleadoGestionando']);
        }
        $stmt->close();
    }

    // CONSULTAR TODOS LOS REPORTES
    public function ConsultarReportesClientes($cnn) {
        $stmt = $cnn->prepare("CALL ConsultarReportesReclamosClientes()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // INSERTAR NUEVOS CASOS DE CLIENTES
    public function InsertarReportesClientesSistema($cnn, $IDDReportes, $IDClienteReportes, $NomClienteReportes, $NomEmpleadoRegistros, $PRODReportes, $MARCAPRReportes, $FECHAREGISTROReportes, $DetallePrReportes, $URGReportes, $EstReportes) {
        $stmt = $cnn->prepare("CALL RegistroNuevosReportesDeClientes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssss", $IDDReportes, $IDClienteReportes, $NomClienteReportes, $NomEmpleadoRegistros, $PRODReportes, $MARCAPRReportes, $FECHAREGISTROReportes, $DetallePrReportes, $URGReportes, $EstReportes);
        
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroInsertadoClientesReportes.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoInsertadoClientesReportes.html');
        }
    }

    // MODIFICAR CASOS DE CLIENTES
    public function ModificarReportesClientesSistema($cnn, $IDDReportes, $IDClienteReportes, $NomClienteReportes, $NomEmpleadoRegistros, $NomEmpleadoGestiones, $PRODReportes, $MARCAPRReportes, $DetallePrReportes, $URGReportes, $EstReportes, $ComentariosReportesEmpleados) {
        $stmt = $cnn->prepare("CALL ModificarReportesDeClientes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssssss", $IDDReportes, $IDClienteReportes, $NomClienteReportes, $NomEmpleadoRegistros, $NomEmpleadoGestiones, $PRODReportes, $MARCAPRReportes, $DetallePrReportes, $URGReportes, $EstReportes, $ComentariosReportesEmpleados);
        
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroModificadoCasosClientes.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoModificadoCasosClientes.html');
        }
    }

    // ELIMINAR CASOS DE CLIENTES
    public function EliminarCasosClientesSistema($cnn, $ID_CasosClientes) {
        $stmt = $cnn->prepare("CALL EliminarReportesDeClientes(?)");
        $stmt->bind_param("i", $ID_CasosClientes);
        $stmt->execute();
        $stmt->close();
    }
} // FIN DE CLASE
?>
