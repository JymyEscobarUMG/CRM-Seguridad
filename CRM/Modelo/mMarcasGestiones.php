<?php
class Marcas {
    // VARIABLES DE GESTION
    private $ID_Marcas;
    private $CODMarcas;
    private $NOMMarcas;
    private $TIPMarcas;

    // ID
    public function setIDMarcas($n){ $this->ID_Marcas = $n; }
    public function getIDMarcas(){ return $this->ID_Marcas; }

    // CODIGO
    public function setCodigoMarcas($n){ $this->CODMarcas = $n; }
    public function getCodigoMarcas(){ return $this->CODMarcas; }

    // DETALLE
    public function setDetalleMarcas($n){ $this->NOMMarcas = $n; }
    public function getDetalleMarcas(){ return $this->NOMMarcas; }

    // TIPO
    public function setTipoMarcas($n){ $this->TIPMarcas = $n; }
    public function getTipoMarcas(){ return $this->TIPMarcas; }

    // CONSULTA ESPECIFICA UNA MARCA
    public function ConsultarUnaMarca($cnn, $ID_Marcas) {
        $stmt = $cnn->prepare("CALL ConsultaMarcasEspecifica(?)");
        $stmt->bind_param("i", $ID_Marcas);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setCodigoMarcas($Usuarios['cod_marca']);
            $this->setDetalleMarcas($Usuarios['marca']);
            $this->setTipoMarcas($Usuarios['tipo']);
        }
        $stmt->close();
    }

    // CONSULTAR TODOS LOS DETALLES DE MARCAS
    public function ConsultarDetalleMarca($cnn) {
        $stmt = $cnn->prepare("CALL ConsultarDetallesDeMarcas()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // INSERTAR NUEVOS DETALLES DE MARCA
    public function RegistroNuevosDetalleMarca($cnn, $IDMarcas, $CODMarcas, $NOMMarcas, $TIPMarcas) {
        $stmt = $cnn->prepare("CALL InsertarNuevosDetallesMarcas(?, ?, ?, ?)");
        $stmt->bind_param("iiss", $IDMarcas, $CODMarcas, $NOMMarcas, $TIPMarcas);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroInsertadoMarcas.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoInsertadoMarcas.html');
        }
    }

    // ELIMINAR MARCA
    public function EliminarMarca($cnn, $ID_Marcas) {
        $stmt = $cnn->prepare("CALL EliminarDetalleMarca(?)");
        $stmt->bind_param("i", $ID_Marcas);
        $stmt->execute();
        $stmt->close();
    }

    // MODIFICAR MARCA
    public function ModificarMarca($cnn, $IDMarcas, $CODMarcas, $NOMMarcas, $TIPMarcas) {
        $stmt = $cnn->prepare("CALL ModificarDetalleMarcas(?, ?, ?, ?)");
        $stmt->bind_param("iiss", $IDMarcas, $CODMarcas, $NOMMarcas, $TIPMarcas);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroModificadoMarcas.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoModificadoMarcas.html');
        }
    }
} // CIERRE DE CLASE MARCAS
?>
