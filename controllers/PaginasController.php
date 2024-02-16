<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        $propiedades=Propiedad::get(3);
        $inicio = true;
        
        $router->render('paginas/index',[
            'propiedades'=>$propiedades,
            'inicio'=>$inicio
        ]);
    }

    public static function nosotros(Router $router){
        $router->render('paginas/nosotros',[

        ]);
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad ::all();

        $router->render('paginas/propiedades', [
            'propiedades'=>$propiedades
        ]);
    }
    public static function propiedad(Router $router){
        $id=validarID('/propiedades');
        $propiedad=Propiedad::find($id);

        $router->render('paginas/propiedad',[
            'propiedad'=>$propiedad
        ]);
    }
    public static function blog(Router $router){
        $router->render('paginas/blog',[
        ]);
    }
    public static function entrada(Router $router){
        $router->render('paginas/entrada',[
        ]);
    }
    public static function contacto(Router $router){
        $mensaje=null;

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $respuestas = $_POST['contacto'];
            
            //Creamos una instancia de PHPMailer
            $phpmailer = new PHPMailer();

            //Configurar SMTP (protocolo para el envío de email)
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = '83cd5be2c30cf0';
            $phpmailer->Password = 'fec623958e0b40';
            //$phpmailer->SMTPSecure = 'tls'; //Esto es para que el email vaya por un tunel seguro, pero no encriptado. tls son las iniciales de Seguridad en la capa de transporte

            //Configurar el contenido del email
            $phpmailer->setFrom('admin@bienesraices.com'); //Quien envía el email
            $phpmailer->addAddress('admin@bienesraices.com','BienesRaices.com');//La direccion que recibe el email
            $phpmailer->Subject = 'Tienes un nuevo mensaje'; //El mensaje que llega cuando tenemos un nuevo email
            
            //Habilitar  HTML
            $phpmailer->isHTML(true);
            $phpmailer->CharSet='UTF-8';

            //Definir el contenido
            $contenido='<html>';
            $contenido.= '<p>Tienes un nuevo mensaje</p>';
            $contenido.= '<p>Nombre:'.$respuestas['nombre'].'</p>';
            $contenido.= '<p>Mensaje:'.$respuestas['mensaje'].'</p>';
            $contenido.= '<p>Vende o Compra:'.$respuestas['tipo'].'</p>';
            $contenido.= '<p>Precio o presupuesto: $'.$respuestas['precio'].'</p>';
            $contenido.= '<p>Prefiere ser contactado por: '.$respuestas['contacto'].'</p>';

            //Verificar que atributos se envían (telefono o mail)
            if ($respuestas['contacto']==='telefono') {
                $contenido.= '<p>Telefono:'.$respuestas['telefono'].'</p>';
                $contenido.= '<p>Fecha para ser contactado: '.$respuestas['fecha'].'</p>';
                $contenido.= '<p>Hora para ser contactado: '.$respuestas['hora'].'</p>';
            }else{
                $contenido.= '<p>Email:'.$respuestas['email'].'</p>';
            }

            $contenido.='</html>';

            $phpmailer->Body=$contenido;

            //Enviar el email
            if($phpmailer->send()){
                $mensaje= "Mensaje enviado correctamente";
            }else{
                $mensaje= "El mensaje no se ha enviado";
            }
        }

        $router->render('paginas/contacto',[
            'mensaje'=>$mensaje
        ]);
    }

}