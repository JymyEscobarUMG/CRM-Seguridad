<?php
class Ciudades{
    // VARIABLES DE GESTION 
    private $IdCiudad;
    private $CodCiudad;
    private $NomCiudad;
    
    // ID
    public function setIDCiudades($n){
        $this->IdCiudad=$n;
    }
    public function getIDCiudades(){
        return $this->IdCiudad;
    }
    
    // CODIGO
    public function setCodCiudades($n){
        $this->CodCiudad=$n;
    }
    public function getCodCiudades(){
        return $this->CodCiudad;
    }
    
    // NOMBRE
    public function setNombreCiudades($n){
        $this->NomCiudad=$n;
    }
    public function getNombreCiudades(){
        return $this->NomCiudad;
    }
    
    // CONSULTA ESPECIFICA UN CLIENTE POR REGISTROS {GESTIONAR CLIENTES}
    public function ConsultarUnaCiudad($cnn, $ID_Ciudades){
        $stmt = $cnn->prepare("CALL ConsultaCiudadesEspecifica(?)");
        $stmt->bind_param("i", $ID_Ciudades);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $Usuarios = $resultado->fetch_assoc();
        
        $this->setCodCiudades($Usuarios['cod_ciudad']);
        $this->setNombreCiudades($Usuarios['nombre_ciu']);
        
        $stmt->close();
    }
    
    // CONSULTAR TODOS LOS USUARIOS -> ADMINISTRADORES
    public function ConsultarCiudades($cnn) {
        $resultado = mysqli_query($cnn, "CALL ConsultarCiudadesRegistradas();");
        return $resultado;
    }
    
    // INSERTAR CIUDADES
    public function InsertarCiudad($cnn, $IdCiu, $CodCiu, $NomCiu) {
        $stmt = $cnn->prepare("CALL InsertarNuevasCiudades(?, ?, ?)");
        $stmt->bind_param("iss", $IdCiu, $CodCiu, $NomCiu);
        
        if($stmt->execute()) {
            include ('../Vista/MensajesUsuarios/RegistroInsertadoCiudades.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoInsertadoCiudades.html');
        }
        
        $stmt->close();
    }
    
    // ELIMINAR CLIENTES
    public function EliminarCiudad($cnn, $ID_Ciudades) {
        $stmt = $cnn->prepare("CALL EliminarCiudades(?)");
        $stmt->bind_param("i", $ID_Ciudades);
        $resultado = $stmt->execute();
        $stmt->close();
        
        return $resultado;
    }
    
    // MODIFICAR CLIENTES
    public function ModificarCiudad($cnn, $IdCiu, $CodCiu, $NomCiu) {
        $stmt = $cnn->prepare("CALL ModificarCiudades(?, ?, ?)");
        $stmt->bind_param("iss", $IdCiu, $CodCiu, $NomCiu);
        
        if($stmt->execute()) {
            include ('../Vista/MensajesUsuarios/RegistroModificadoCiudades.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoModificadoCiudades.html');
        }
        
        $stmt->close();
    }
}
// CIERRE DE CLASE CIUDADES 
?>