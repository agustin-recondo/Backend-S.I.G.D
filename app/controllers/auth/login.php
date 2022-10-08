<?php
$ruta = getcwd();

use GrahamCampbell\ResultType\Success;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once($ruta . '/app/controllers/auth/token.php');
require_once($ruta . '/app/helpers/helpers.php');
require_once($ruta . '\app\models\Usuario.php');
class LoginController
{

    function __construct()
    {
    }

    /******************************************
     * SOLICITAR CAMBIO DE CONTRASEÑA
     ******************************************/

    function requestResetPassword($email)
    {
        //Verificar que existe el email en la bd
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->getUser($email);
        if (!$usuario) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => 'El email no esta asociado a ningun usuario',
            );
            return $respuesta;
        }

        //Crear token para asociarlo al correo
        $tokenController = new TokenController();
        $jwt = $tokenController->generarTokenResetPassword($email, $usuario['Password']);

        //ENVIAR EMAIL DE CONFIRMACION
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = true;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['email_soporte'];
            $mail->Password   = $_ENV['email_password'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('sigd.soporte@gmail.com', 'S.I.G.D');
            $mail->addAddress('giliwew127@civikli.com', $usuario['NomUsuario'].' '.$usuario['ApUsuario']);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Recuperar contraseña - S.I.G.D.';
            $mail->Body    = '<!DOCTYPE html> <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml"> <head> <title></title> <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/> <meta content="width=device-width, initial-scale=1.0" name="viewport"/> <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/> <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css"/> <style>*{box-sizing: border-box;}body{margin: 0; padding: 0;}a[x-apple-data-detectors]{color: inherit !important; text-decoration: inherit !important;}#MessageViewBody a{color: inherit; text-decoration: none;}p{line-height: inherit}.desktop_hide, .desktop_hide table{mso-hide: all; display: none; max-height: 0px; overflow: hidden;}@media (max-width:620px){.desktop_hide table.icons-inner, .social_block.desktop_hide .social-table{display: inline-block !important;}.icons-inner{text-align: center;}.icons-inner td{margin: 0 auto;}.image_block img.big, .row-content{width: 100% !important;}.mobile_hide{display: none;}.stack .column{width: 100%; display: block;}.mobile_hide{min-height: 0; max-height: 0; max-width: 0; overflow: hidden; font-size: 0px;}.desktop_hide, .desktop_hide table{display: table !important; max-height: none !important;}}</style> </head> <body style="background-color: #d9dffa; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;"> <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #d9dffa;" width="100%"> <tbody> <tr> <td> <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #cfd6f4;" width="100%"> <tbody> <tr> <td> <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600"> <tbody> <tr> <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 20px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%"> <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"> <tr> <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;"> <div align="center" class="alignment" style="line-height:10px"><img alt="Card Header with Border and Shadow Animated" class="big" src="https://i.ibb.co/v1KQjyk/animated-header.gif" style="display: block; height: auto; border: 0; width: 600px; max-width: 100%;" title="Card Header with Border and Shadow Animated" width="600"/></div></td></tr></table> </td></tr></tbody> </table> </td></tr></tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #d9dffa; background-image: url(\'https://i.ibb.co/Tc7znK6/body-background-2.png\'); background-position: top center; background-repeat: repeat;" width="100%"> <tbody> <tr> <td> <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600"> <tbody> <tr> <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-left: 50px; padding-right: 50px; vertical-align: top; padding-top: 15px; padding-bottom: 15px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%"> <table border="0" cellpadding="10" cellspacing="0" class="text_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%"> <tr> <td class="pad"> <div style="font-family: sans-serif"> <div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #506bec; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;"> <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"><strong><span style="font-size:38px;">¿Olvidaste tu contraseña?</span></strong></p></div></div></td></tr></table> <table border="0" cellpadding="10" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%"> <tr> <td class="pad"> <div style="font-family: sans-serif"> <div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #40507a; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;"> <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;"><span style="font-size:16px;">Hola '.$usuario['NomUsuario'].' '.$usuario['ApUsuario'].'! Esto es un correo automático enviado para recuperar tu contraseña.</span></p></div></div></td></tr></table> <table border="0" cellpadding="0" cellspacing="0" class="button_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"> <tr> <td class="pad" style="padding-bottom:20px;padding-left:10px;padding-right:10px;padding-top:20px;text-align:left;"> <div align="left" class="alignment"> <a href="http://sigd-frontend.localhost/resetPassword?token=' . $jwt . '" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#506bec;border-radius:16px;width:auto;border-top:0px solid TRANSPARENT;font-weight:400;border-right:0px solid TRANSPARENT;border-bottom:0px solid TRANSPARENT;border-left:0px solid TRANSPARENT;padding-top:8px;padding-bottom:8px;font-family:Helvetica Neue, Helvetica, Arial, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;" target="_blank"><span style="padding-left:25px;padding-right:20px;font-size:15px;display:inline-block;letter-spacing:normal;"><span dir="ltr" style="word-break: break-word;"><span data-mce-style="" dir="ltr" style="line-height: 30px;"><strong>REINICIAR CONTRASEÑA</strong></span></span></span></a> </div></td></tr></table> <table border="0" cellpadding="10" cellspacing="0" class="text_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%"> <tr> <td class="pad"> <div style="font-family: sans-serif"> <div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #40507a; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;"> <p style="margin: 0; font-size: 14px; mso-line-height-alt: 16.8px;">¿No solicitaste reiniciar tu contraseña? Simplemente ignora este correo.</p></div></div></td></tr></table> </td></tr></tbody> </table> </td></tr></tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"> <tbody> <tr> <td> <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600"> <tbody> <tr> <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%"> <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"> <tr> <td class="pad" style="width:100%;padding-right:0px;padding-left:0px;"> <div align="center" class="alignment" style="line-height:10px"><img alt="Card Bottom with Border and Shadow Image" class="big" src="https://i.ibb.co/FDVvKxy/bottom-img.png" style="display: block; height: auto; border: 0; width: 600px; max-width: 100%;" title="Card Bottom with Border and Shadow Image" width="600"/></div></td></tr></table> </td></tr></tbody> </table> </td></tr></tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"> <tbody> <tr> <td> <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600"> <tbody> <tr> <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-left: 10px; padding-right: 10px; vertical-align: top; padding-top: 10px; padding-bottom: 20px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%"> <table border="0" cellpadding="10" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"> <tr> <td class="pad"> <div align="center" class="alignment" style="line-height:10px"><a href="http://www.example.com/" style="outline:none" tabindex="-1" target="_blank"><img alt="Your Logo" src="https://i.ibb.co/QjGnrjy/logo-pagina.png" style="display: block; height: auto; border: 0; width: 70px; max-width: 100%;" title="Your Logo" width="145"/></a></div></td></tr></table> <table border="0" cellpadding="10" cellspacing="0" class="social_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"> <tr> <td class="pad"> <div class="alignment" style="text-align:center;"> <table border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;" width="72px"> <tr> <td style="padding:0 2px 0 2px;"><a href="https://www.instagram.com/" target="_blank"><img alt="Instagram" height="32" src="https://i.ibb.co/qBpFb4R/instagram2x.png" style="display: block; height: auto; border: 0;" title="instagram" width="32"/></a></td><td style="padding:0 2px 0 2px;"><a href="https://www.twitter.com/" target="_blank"><img alt="Twitter" height="32" src="https://i.ibb.co/GpMpT7P/twitter2x.png" style="display: block; height: auto; border: 0;" title="twitter" width="32"/></a></td></tr></table> </div></td></tr></table> <table border="0" cellpadding="10" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%"> <tr> <td class="pad"> <div style="font-family: sans-serif"> <div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #97a2da; line-height: 1.2; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;"> <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;">Este correo expirara en 24 horas</p></div></div></td></tr></table> </td></tr></tbody> </table> </td></tr></tbody> </table> <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"> <tbody> <tr> <td> <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600"> <tbody> <tr> <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%"> <table border="0" cellpadding="0" cellspacing="0" class="icons_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"> <tr> <td class="pad" style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;"> <table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%"> <tr> <td class="alignment" style="vertical-align: middle; text-align: center;"> </td></tr></table> </td></tr></table> </td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody> </table> </body> </html>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            // Activo condificacción utf-8
            $mail->CharSet = 'UTF-8';
            $mail->send();
        } catch (Exception $e) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Hubo un error al enviar el correo electronico",
            );
            return ($respuesta);
        }

        $respuesta = array(
            'success' => 1,
            'mensaje' => "Se envio un correo electronico para cambiar la contraseña, revise su email.",
            'token' => $jwt
        );
        return ($respuesta);
    }
    /******************************************
     * LOGIN
     ******************************************/
    function login()
    {
        /******************************
         * Comprobar validez del correo y contraseña
         ******************************/
        if (!isset($_POST['email']) || !validateEmail($_POST['email'])) {
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'Correo electronico invalido',
            );
            return ($respuesta);
        }

        $email = $_POST['email'];

        if (!isset($_POST['password']) || !validatePassword($_POST['password'])) {
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'La contraseña debe contener al menos 8 caracteres, una mayuscula, un numero y un caracter especial',
            );
            return ($respuesta);
        }
        $password = hash('sha256',$_POST['password']);
        /******************************
         * Comprobar que el email existe en la BD
         ******************************/
        $modelo = new UsuarioModel();
        $usuario = $modelo->getUser($email);
        if (!$usuario) {
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'El correo no es correcto',
            );
            return ($respuesta);
        }

        /******************************
         * Validar que la contraseña coincida
         ******************************/
        if ($usuario['Password'] != $password) {
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'La contraseña no es correcta',
            );
            return ($respuesta);
        }

        /******************************
         * Generar Token y guardarlo en BD
         ******************************/

        $tokenController = new TokenController();
        $jwt = $tokenController->generarToken($usuario);

        $respuesta = array(
            "success" => 1,
            "mensaje" => 'Inicio de sesión exitoso',
            "token" => $jwt['token'],
        );

        return ($respuesta);
    }

    /******************************************
     * RESET PASSWORD
     ******************************************/
    function resetPassword()
    {
        if (!isset($_POST['email']) || !validateEmail($_POST['email'])) {
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'Correo electronico invalido',
            );
            return ($respuesta);
        }

        $email = $_POST['email'];

        if (!isset($_POST['password']) || !validatePassword($_POST['password'])) {
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'La contraseña debe contener al menos 8 caracteres, una mayuscula, un numero y un caracter especial',
            );
            return ($respuesta);
        }
        $password = hash('sha256', $_POST['password']);

        $usuarioControler = new UsuarioModel();

        $usuario = $usuarioControler->getUser($email);

        if (!$usuario) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => 'El email no esta asociado a ningun usuario'
            );

            return $respuesta;
        }

        $updatePassword = $usuarioControler->resetPassword($email, $password);

        if (!$updatePassword) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => 'No se pudo actualizar la contraseña, intente más tarde'
            );
        }

        $respuesta = array(
            'success' => 1,
            'mensaje' => 'La contraseña se actualizo correctamente'
        );

        return $respuesta;
    }
}
