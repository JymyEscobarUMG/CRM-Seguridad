<?php
class Ventas {
    // VARIABLES DE GESTION
    private $Id_Factura;
    private $Cod_Factura;
    private $Pago_Factura;
    private $Modelo_Factura;
    private $Licencia_Factura;
    private $TipoSi_Factura;

    // --- GETTERS & SETTERS ---
    public function setIDFactura($n){ $this->Id_Factura = $n; }
    public function getIDFactura(){ return $this->Id_Factura; }

    public function setCODFactura($n){ $this->Cod_Factura = $n; }
    public function getCODFactura(){ return $this->Cod_Factura; }

    public function setPagoFactura($n){ $this->Pago_Factura = $n; }
    public function getPagoFactura(){ return $this->Pago_Factura; }

    public function setModeloFactura($n){ $this->Modelo_Factura = $n; }
    public function getModeloFactura(){ return $this->Modelo_Factura; }

    public function setLicenciaFactura($n){ $this->Licencia_Factura = $n; }
    public function getLicenciaFactura(){ return $this->Licencia_Factura; }

    public function setTipoSIFactura($n){ $this->TipoSi_Factura = $n; }
    public function getTipoSIFactura(){ return $this->TipoSi_Factura; }

    // --- CONSULTAR FACTURA POR ID ---
    public function ConsultarUnaFacturacion($cnn, $ID_FacturacionClientes) {
        $stmt = $cnn->prepare("CALL ConsultaEspecificaFacturaciones(?)");
        $stmt->bind_param("i", $ID_FacturacionClientes); // id_factura = INT
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setIDFactura($Usuarios['id_factura']);
            $this->setCODFactura($Usuarios['cod_factura']);
            $this->setPagoFactura($Usuarios['pago']);
            $this->setModeloFactura($Usuarios['modelo']);
            $this->setLicenciaFactura($Usuarios['licencia']);
            $this->setTipoSIFactura($Usuarios['tipoSI']);
        }
        $stmt->close();
    }

    // --- CONSULTAR TODAS LAS FACTURAS ---
    public function ConsultarDetallesFacturas($cnn) {
        $stmt = $cnn->prepare("CALL ConsultarDetallesVentas()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // --- INSERTAR NUEVA FACTURA ---
    public function InsertarFacturaciones($cnn, $IDFacturacion, $CODFacturacion, $MONTOFacturacion, $MODELOFacturacion, $LICENCIAFacturacion, $TIPOSIFacturacion) {
        $stmt = $cnn->prepare("CALL InsertarNuevasFacturas(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", 
            $IDFacturacion,       // INT
            $CODFacturacion,      // INT
            $MONTOFacturacion,    // DOUBLE
            $MODELOFacturacion,   // VARCHAR(50)
            $LICENCIAFacturacion, // CHAR(10)
            $TIPOSIFacturacion    // VARCHAR(25)
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroInsertadoFacturas.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoInsertadoFacturas.html');
        }
    }

    // --- ELIMINAR FACTURA ---
    public function EliminarVentas($cnn, $ID_FacturacionClientes) {
        $stmt = $cnn->prepare("CALL EliminarDetalleVenta(?)");
        $stmt->bind_param("i", $ID_FacturacionClientes); // id_factura = INT
        $stmt->execute();
        $stmt->close();
    }

    // --- MODIFICAR FACTURA ---
    public function ModificarFacturaciones($cnn, $IDFacturacion, $MONTOFacturacion, $MODELOFacturacion, $LICENCIAFacturacion, $TIPOSIFacturacion) {
        $stmt = $cnn->prepare("CALL ModificarDetalleVenta(?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", 
            $IDFacturacion,       // INT
            $MONTOFacturacion,    // DOUBLE
            $MODELOFacturacion,   // VARCHAR(50)
            $LICENCIAFacturacion, // CHAR(10)
            $TIPOSIFacturacion    // VARCHAR(25)
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroModificadoVentas.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoModificadoVentas.html');
        }
    }
}
?>
