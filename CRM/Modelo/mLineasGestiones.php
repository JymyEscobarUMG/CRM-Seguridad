<?php
class Lineas {
    // VARIABLES DE GESTION
    private $Id_Linea;
    private $Cod_Linea;
    private $Tipo_Linea;

    // ID
    public function setIDLinea($n){ $this->Id_Linea=$n; }
    public function getIDLinea(){ return $this->Id_Linea; }

    // CODIGO
    public function setCodLinea($n){ $this->Cod_Linea=$n; }
    public function getCodLinea(){ return $this->Cod_Linea; }

    // TIPO LINEA
    public function setTipoLinea($n){ $this->Tipo_Linea=$n; }
    public function getTipoLinea(){ return $this->Tipo_Linea; }

    // CONSULTA ESPECIFICA UNA LINEA
    public function ConsultarUnaLineaRegistrada($cnn, $ID_LineasGestiones) {
        $stmt = $cnn->prepare("CALL ConsultaEspecificaLineas(?)");
        $stmt->bind_param("i", $ID_LineasGestiones);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setCodLinea($Usuarios['cod_linea']);
            $this->setTipoLinea($Usuarios['tipo']);
        }
        $stmt->close();
    }

    // CONSULTAR TODAS LAS LINEAS
    public function ConsultarLineas($cnn) {
        $stmt = $cnn->prepare("CALL ConsultarLineasRegistradas()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // INSERTAR NUEVAS LINEAS
    public function InsertarNuevasLineasSistema($cnn, $IDELineas, $CODILineas, $TIPPLineas) {
        $stmt = $cnn->prepare("CALL RegistroNuevasLineas(?, ?, ?)");
        $stmt->bind_param("iis", $IDELineas, $CODILineas, $TIPPLineas);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroInsertadoLineas.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoInsertadoLineas.html');
        }
    }

    // ELIMINAR LINEAS
    public function EliminarLineasGestiones($cnn, $ID_LineasGestiones) {
        $stmt = $cnn->prepare("CALL EliminarLineas(?)");
        $stmt->bind_param("i", $ID_LineasGestiones);
        $stmt->execute();
        $stmt->close();
    }

    // MODIFICAR LINEAS
    public function ModificarLineasSistema($cnn, $IDELineas, $TIPPLineas) {
        $stmt = $cnn->prepare("CALL ModificarLineas(?, ?)");
        $stmt->bind_param("is", $IDELineas, $TIPPLineas);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroModificadoLineas.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoModificadoLineas.html');
        }
    }
} // CIERRE DE CLASE LINEAS
?>
