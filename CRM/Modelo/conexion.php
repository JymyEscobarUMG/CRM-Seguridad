<?php
/*  
    ------------------------------------------------
          INFORMACION TECNICA DEL SISTEMA
    ------------------------------------------------
        -> Autor: Daniel Rivera  
            https://github.com/DanielRivera03
    
        -> Sistema gestion de Casos [CRM]
            PHP Puro / MVC
        
        -> Inspirado bajo el software de codigo
            abierto VTiger Real, este sistema no
            tiene ninguna relacion directa con 
            el sistema mencionado previamente

        -> Creditos logo: https://www.vtiger.com/
    ---------------------------------------------------
    COMPARTIDO Y LIBERADO CON FINES ACADEMICOS 
    ---------------------------------------------------   
*/
class Conexion {
    private $servidor = "localhost";
    private $usuario  = "root";
    private $clave    = "1234";   // ⚠️ RECOMENDADO: usar variables de entorno en producción
    private $base     = "crm";
    public  $conex;

    // Cambiar servidor si se necesita
    public function setServidor($s) { $this->servidor = $s; }
    public function getServidor() { return $this->servidor; }

    // Conexión principal
    public function conectar($bd = null) {
        $db = $bd ?? $this->base;
        $misql = new mysqli($this->servidor, $this->usuario, $this->clave, $db);

        if ($misql->connect_errno) {
            $mensaje = "Error de conexión: " . $misql->connect_error;
        } else {
            $mensaje = "Conexión exitosa.";
            $this->conex = $misql;
        }
        return $mensaje;
    }

    // LOGIN ADMINISTRADORES
    public function login($cnn, $Usuario, $Pass) {
        $stmt = $cnn->prepare("CALL ValidarLogin(?)");
        $stmt->bind_param("s", $Usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();

        if ($resultado->num_rows === 1) {
            $usuarioData = $resultado->fetch_assoc();
            $hash = $usuarioData['contrasenia'];

            // 1. Validar si ya está encriptada
            if (password_verify($Pass, $hash)) {
                return $usuarioData;
            }

            // 2. Si no está encriptada y coincide en texto plano
            if ($Pass === $hash) {
                // Encriptar ahora y actualizar en la BD
                $nuevoHash = password_hash($Pass, PASSWORD_BCRYPT);

                $update = $cnn->prepare("UPDATE administradores SET contrasenia = ? WHERE id_admin = ?");
                $update->bind_param("si", $nuevoHash, $usuarioData['id_admin']);
                $update->execute();
                $update->close();

                // Actualizar el array en memoria
                $usuarioData['contrasenia'] = $nuevoHash;

                return $usuarioData;
            }
        }

        return null; // Credenciales incorrectas
    }


    // LOGIN EMPLEADOS
    public function loginEmpleados($cnn, $Usuario, $Pass) {
    // 1. Llamar al procedimiento almacenado que obtiene al usuario
    $stmt = $cnn->prepare("CALL ValidarLoginEmpleados(?)");
    $stmt->bind_param("s", $Usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $stmt->close();

    // 2. Verificar que exista el usuario
    if ($resultado->num_rows === 1) {
        $usuarioData = $resultado->fetch_assoc();
        $hash = $usuarioData['contrasenia'];

        // 3. Validar si ya está encriptada
        if (password_verify($Pass, $hash)) {
            return $usuarioData; // Login correcto
        }

        // 4. Si no está encriptada y coincide con la contraseña en texto plano
        if ($Pass === $hash) {
            // Generar nuevo hash seguro
            $nuevoHash = password_hash($Pass, PASSWORD_BCRYPT);

            // Actualizar la base de datos con la nueva contraseña encriptada
            $update = $cnn->prepare("UPDATE logincliente SET contrasenia = ? WHERE id_cliente = ?");
            $update->bind_param("si", $nuevoHash, $usuarioData['id_cliente']);
            $update->execute();
            $update->close();

            // Actualizar el array en memoria para mantener consistencia
            $usuarioData['contrasenia'] = $nuevoHash;

            return $usuarioData; // Login correcto después de migrar la contraseña
        }
    }

    // Si no pasa ninguna validación
    return null;
}

}

// ================================
// CONEXIÓN PRINCIPAL DEL SISTEMA
// ================================
$con = new Conexion();
$con->conectar("crm");
$cnn = $con->conex;

// ================================
// CONEXIONES SECUNDARIAS
// ================================
// Estas conexiones parecen ser usadas para consultas de conteo/graficación.
// En lugar de crear muchas instancias nuevas, podrías reusar la misma conexión.
// Pero las dejo como en tu código original para compatibilidad.

$con1 = new Conexion(); $con1->conectar("crm"); $cnn1 = $con1->conex;
$con2 = new Conexion(); $con2->conectar("crm"); $cnn2 = $con2->conex;
$con3 = new Conexion(); $con3->conectar("crm"); $cnn3 = $con3->conex;
$con4 = new Conexion(); $con4->conectar("crm"); $cnn4 = $con4->conex;
$con5 = new Conexion(); $con5->conectar("crm"); $cnn5 = $con5->conex;
$con6 = new Conexion(); $con6->conectar("crm"); $cnn6 = $con6->conex;
$con7 = new Conexion(); $con7->conectar("crm"); $cnn7 = $con7->conex;
$con8 = new Conexion(); $con8->conectar("crm"); $cnn8 = $con8->conex;
?>
