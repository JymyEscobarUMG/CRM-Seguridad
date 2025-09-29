<?php
class Sucursales {
    // VARIABLES DE GESTION
    private $Id_Sucursal;
    private $Cod_Sucursal;
    private $Nombre_Sucursal;
    private $Telefono_Sucursal;
    private $Direccion_Sucursal;
    private $Correo_Sucursal;

    // ID
    public function setIDSucursales($n){ $this->Id_Sucursal=$n; }
    public function getIDSucursales(){ return $this->Id_Sucursal; }

    // CODIGO
    public function setCODSucursales($n){ $this->Cod_Sucursal=$n; }
    public function getCODSucursales(){ return $this->Cod_Sucursal; }

    // NOMBRE
    public function setNOMBRESucursales($n){ $this->Nombre_Sucursal=$n; }
    public function getNOMBRESucursales(){ return $this->Nombre_Sucursal; }

    // TELEFONO
    public function setTELEFONOSucursales($n){ $this->Telefono_Sucursal=$n; }
    public function getTELEFONOSucursales(){ return $this->Telefono_Sucursal; }

    // DIRECCION
    public function setDIRECCIONSucursales($n){ $this->Direccion_Sucursal=$n; }
    public function getDIRECCIONSucursales(){ return $this->Direccion_Sucursal; }

    // CORREO
    public function setCORREOSucursales($n){ $this->Correo_Sucursal=$n; }
    public function getCORREOSucursales(){ return $this->Correo_Sucursal; }

    // CONSULTA ESPECIFICA UNA SUCURSAL
    public function ConsultarUnaSucursal($cnn, $Id_Sucursales) {
        $stmt = $cnn->prepare("CALL ConsultaSucursalesEspecifica(?)");
        $stmt->bind_param("i", $Id_Sucursales);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setCODSucursales($Usuarios['cod_sucursal']);
            $this->setNOMBRESucursales($Usuarios['nombre_suc']);
            $this->setTELEFONOSucursales($Usuarios['telefono']);
            $this->setDIRECCIONSucursales($Usuarios['direccion']);
            $this->setCORREOSucursales($Usuarios['correo']);
        }
        $stmt->close();
    }

    // CONSULTAR TODAS LAS SUCURSALES
    public function ConsultarTodasSucursales($cnn) {
        $stmt = $cnn->prepare("CALL ConsultarSucursales()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // INSERTAR NUEVAS SUCURSALES
    public function InsertarNuevasSucursales($cnn, $IDSucursal, $CODSucursal, $NOMSucursal, $TELSucursal, $DIRSucursal, $CORREOSucursal) {
        $stmt = $cnn->prepare("CALL InsertarSucursalesNuevas(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $IDSucursal, $CODSucursal, $NOMSucursal, $TELSucursal, $DIRSucursal, $CORREOSucursal);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroInsertadoSucursal.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoInsertadoSucursal.html');
        }
    }

    // ELIMINAR SUCURSAL
    public function EliminarSucursales($cnn, $Id_Sucursales) {
        $stmt = $cnn->prepare("CALL EliminarSucursalesSistema(?)");
        $stmt->bind_param("i", $Id_Sucursales);
        $stmt->execute();
        $stmt->close();
    }

    // MODIFICAR SUCURSAL
    public function ModificarSucursal($cnn, $CODSucursal, $NOMSucursal, $TELSucursal, $DIRSucursal, $CORREOSucursal) {
        $stmt = $cnn->prepare("CALL ModificarSucursalesSistema(?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $CODSucursal, $NOMSucursal, $TELSucursal, $DIRSucursal, $CORREOSucursal);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroModificadoSucursales.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoModificadoSucursales.html');
        }
    }
} // CIERRE DE CLASE SUCURSALES
?>
