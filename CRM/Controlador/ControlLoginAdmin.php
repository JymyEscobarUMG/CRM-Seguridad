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
session_start();
// CONEXION DE SISTEMA CRM -> IMPORTANDO ARCHIVO
require(__DIR__ . '/../Modelo/conexion.php');
// ACC -> ACCION CONTROLADOR {URL}
if(isset($_GET['acc']))
{
	$accion=$_GET['acc'];  // ENVIO GET DE VALOR ACCION {URL}
}
else
{
	$accion=1;  // VALOR POR DEFECTO
}
switch ($accion) 
{
    case 1:
  require(__DIR__ . '/../Vista/LoginAdministradores.php');
    	break;
    case 2:
     	// VALIDAR reCAPTCHA
         if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
             header('location:../Vista/MensajeUsuarios.php?error=recaptcha_missing');
             exit;
         }

         $recaptcha_secret = env('RECAPTCHA_SECRET_KEY');
         $recaptcha_response = $_POST['g-recaptcha-response'];
         $url = 'https://www.google.com/recaptcha/api/siteverify';
         $data = [
             'secret' => $recaptcha_secret,
             'response' => $recaptcha_response
         ];
         $options = [
             'http' => [
                 'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                 'method' => 'POST',
                 'content' => http_build_query($data)
             ]
         ];
         $context = stream_context_create($options);
         $result = file_get_contents($url, false, $context);
         $result_json = json_decode($result, true);
         if (!$result_json['success']) {
             header('location:../Vista/MensajeUsuarios.php?error=recaptcha_invalid');
             exit;
         }

         // VALIDAR INICIO DE SESIÓN
         $usuario = $con->login($cnn, $_POST['Usuario'], $_POST['Clave']);

        if ($usuario) {
            // Inicializar variables de sesión
            $_SESSION['vsUsuario'] = $usuario['nombre_usuario'];
            $_SESSION['vsTipo'] = $usuario['tipo_usuario'];
            $_SESSION['vsCodigo'] = $usuario['id_admin'];
            $_SESSION['vsCodigoUs'] = $usuario['cod_admin'];
            $_SESSION['vsFotosPerfilesUs'] = $usuario['foto_perfil'];

            if ($usuario['tipo_usuario'] === 'Administrador') {
                header('location:../Vista/AdministracionAdmin.php?acc=1');
            } else {
                header('location:../Vista/AdministracionAdmin.php?acc=2');
            }
        } else {
            // Usuario no encontrado o contraseña incorrecta
            header('location:../Vista/MensajeUsuarios.php');
        }
        break;
		
    	default:
    		header ('location:../Vista/MensajeUsuarios.php');
    	break;	
}
?>