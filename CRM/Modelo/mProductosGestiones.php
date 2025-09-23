<?php
class Productos {
    // VARIABLES DE GESTION
    private $IdProducto;
    private $CodProducto;
    private $NombreProducto;
    private $TipoProducto;
    private $CantidadProducto;
    private $MarcaProducto;
    private $GarantiaProducto;

    // ID
    public function setIDProductos($n){ $this->IdProducto = $n; }
    public function getIDProductos(){ return $this->IdProducto; }

    // CODIGO
    public function setCodProductos($n){ $this->CodProducto = $n; }
    public function getCodProductos(){ return $this->CodProducto; }

    // NOMBRE
    public function setNombreProductos($n){ $this->NombreProducto = $n; }
    public function getNombreProductos(){ return $this->NombreProducto; }

    // TIPO
    public function setTipoProductos($n){ $this->TipoProducto = $n; }
    public function getTipoProductos(){ return $this->TipoProducto; }

    // CANTIDAD
    public function setCantidadProductos($n){ $this->CantidadProducto = $n; }
    public function getCantidadProductos(){ return $this->CantidadProducto; }

    // MARCA
    public function setMarcaProductos($n){ $this->MarcaProducto = $n; }
    public function getMarcaProductos(){ return $this->MarcaProducto; }

    // GARANTIA
    public function setGarantiaProductos($n){ $this->GarantiaProducto = $n; }
    public function getGarantiaProductos(){ return $this->GarantiaProducto; }

    // CONSULTA ESPECIFICA UN PRODUCTO
    public function ConsultarUnProducto($cnn, $ID_Productos) {
        $stmt = $cnn->prepare("CALL ConsultaProductosEspecifica(?)");
        $stmt->bind_param("i", $ID_Productos);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setIDProductos($Usuarios['id_producto']);
            $this->setCodProductos($Usuarios['cod_producto']);
            $this->setNombreProductos($Usuarios['nombre']);
            $this->setTipoProductos($Usuarios['tipo']);
            $this->setCantidadProductos($Usuarios['Cantidad']);
            $this->setMarcaProductos($Usuarios['marca']);
            $this->setGarantiaProductos($Usuarios['garantia']);
        }
        $stmt->close();
    }

    // CONSULTAR TODOS LOS PRODUCTOS
    public function ConsultarProductos($cnn) {
        $stmt = $cnn->prepare("CALL ConsultarProductosRegistrados()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // INSERTAR NUEVOS PRODUCTOS
    public function InsertarProductoSistema($cnn, $IDPro, $CODPro, $NOMPro, $TIPPro, $CANPro, $MARPro, $GARAPro) {
        $stmt = $cnn->prepare("CALL InsertarProductosSistema(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiss", $IDPro, $CODPro, $NOMPro, $TIPPro, $CANPro, $MARPro, $GARAPro);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroInsertadoProductos.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoInsertadoProductos.html');
        }
    }

    // ELIMINAR PRODUCTOS
    public function EliminarProductoSistema($cnn, $ID_Productos) {
        $stmt = $cnn->prepare("CALL EliminarProductosSistema(?)");
        $stmt->bind_param("i", $ID_Productos);
        $stmt->execute();
        $stmt->close();
    }

    // MODIFICAR PRODUCTOS
    public function ModificarProductoSistema($cnn, $IDPro, $CODPro, $NOMPro, $TIPPro, $CANPro, $MARPro, $GARAPro) {
        $stmt = $cnn->prepare("CALL ModificarProductosSistema(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiss", $IDPro, $CODPro, $NOMPro, $TIPPro, $CANPro, $MARPro, $GARAPro);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include ('../Vista/MensajesUsuarios/RegistroModificadoProductos.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoModificadoProductos.html');
        }
    }
} // CIERRE DE CLASE PRODUCTOS
?>
