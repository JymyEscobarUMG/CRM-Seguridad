<?php
class ReportesPlataforma {
    // VARIABLES DE GESTION
    private $Id_ReportePlataforma;
    private $Id_UsuarioReportePlataforma;
    private $Nombre_UsuarioReportePlataforma;
    private $Nombre_UsuarioGestion;
    private $Detalles_ReportePlataforma;
    private $Urgencia_ReportePlataforma;
    private $Estado_ReportePlataforma;
    private $Comentarios_ReportePlataforma;

    // --- GETTERS & SETTERS ---
    public function setIDReportePlataforma($n){ $this->Id_ReportePlataforma = $n; }
    public function getIDReportePlataforma(){ return $this->Id_ReportePlataforma; }

    public function setIDUsuarioReportePlataforma($n){ $this->Id_UsuarioReportePlataforma = $n; }
    public function getIDUsuarioReportePlataforma(){ return $this->Id_UsuarioReportePlataforma; }

    public function setNombreUsuarioReportePlataforma($n){ $this->Nombre_UsuarioReportePlataforma = $n; }
    public function getNombreUsuarioReportePlataforma(){ return $this->Nombre_UsuarioReportePlataforma; }

    public function setNombreUsuarioGestionReportePlataforma($n){ $this->Nombre_UsuarioGestion = $n; }
    public function getNombreUsuarioGestionReportePlataforma(){ return $this->Nombre_UsuarioGestion; }

    public function setDetalleReportePlataforma($n){ $this->Detalles_ReportePlataforma = $n; }
    public function getDetalleReportePlataforma(){ return $this->Detalles_ReportePlataforma; }

    public function setUrgenciaReportePlataforma($n){ $this->Urgencia_ReportePlataforma = $n; }
    public function getUrgenciaReportePlataforma(){ return $this->Urgencia_ReportePlataforma; }

    public function setEstadoReportePlataforma($n){ $this->Estado_ReportePlataforma = $n; }
    public function getEstadoReportePlataforma(){ return $this->Estado_ReportePlataforma; }

    public function setComentariosReportePlataforma($n){ $this->Comentarios_ReportePlataforma = $n; }
    public function getComentariosReportePlataforma(){ return $this->Comentarios_ReportePlataforma; }

    // --- CONSULTA ESPECÍFICA ---
    public function ConsultarUnReportePlataforma($cnn, $ID_ReporteSistema) {
        $stmt = $cnn->prepare("CALL ConsultaEspecificaReportesPlataforma(?)");
        $stmt->bind_param("s", $ID_ReporteSistema); // CHAR(100) => string
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setIDUsuarioReportePlataforma($Usuarios['Id_cliente']);
            $this->setNombreUsuarioReportePlataforma($Usuarios['nombre_usuario']);
            $this->setNombreUsuarioGestionReportePlataforma($Usuarios['usuario_gestion']);
            $this->setDetalleReportePlataforma($Usuarios['DetallesReporte']);
            $this->setUrgenciaReportePlataforma($Usuarios['Urgencia']);
            $this->setEstadoReportePlataforma($Usuarios['EstadoReporte']);
            $this->setComentariosReportePlataforma($Usuarios['Comentarios_Finales']);
        }

        $stmt->close();
    }

    // --- CONSULTAR TODOS LOS REPORTES ---
    public function ConsultarReportesPlataforma($cnn) {
        $stmt = $cnn->prepare("CALL ConsultarReportesPlataforma()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // --- INSERTAR NUEVOS REPORTES ---
    public function InsertarReportesPlataforma($cnn, $IDDReportePlataforma, $IDUsuarioReportePlataforma, $NombreUsuarioReportePlataforma, $DetalleREReportePlataforma, $URGENCIAReportePlataforma, $ESTADOReportePlataforma) {
        $stmt = $cnn->prepare("CALL RegistroNuevosReportesDePlataforma(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sissss",
            $IDDReportePlataforma,
            $IDUsuarioReportePlataforma,
            $NombreUsuarioReportePlataforma,
            $DetalleREReportePlataforma,
            $URGENCIAReportePlataforma,
            $ESTADOReportePlataforma
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroInsertadoPlataformaReportes.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoInsertadoPlataformaReportes.html');
        }
    }

    // --- ELIMINAR REPORTE ---
    public function EliminarReportesSistema($cnn, $ID_ReporteSistema) {
        $stmt = $cnn->prepare("CALL EliminarReportesDePlataforma(?)");
        $stmt->bind_param("s", $ID_ReporteSistema); // CHAR(100) => string
        $stmt->execute();
        $stmt->close();
    }

    // --- MODIFICAR REPORTE ---
    public function ModificarReportesPlataforma($cnn, $IDDReportePlataforma, $IDUsuarioReportePlataforma, $NombreUsuarioReportePlataforma, $NombreUsuarioGestionandoReportePlataforma, $DetalleREReportePlataforma, $URGENCIAReportePlataforma, $ESTADOReportePlataforma, $COMReportePlataforma) {
        $stmt = $cnn->prepare("CALL ModificarReportesDePlataforma(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sissssss",
            $IDDReportePlataforma,
            $IDUsuarioReportePlataforma,
            $NombreUsuarioReportePlataforma,
            $NombreUsuarioGestionandoReportePlataforma,
            $DetalleREReportePlataforma,
            $URGENCIAReportePlataforma,
            $ESTADOReportePlataforma,
            $COMReportePlataforma
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroModificadoReportesPlataforma.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoModificadoReportesPlataforma.html');
        }
    }
}
?>
