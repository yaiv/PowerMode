<?php 

namespace Controllers;
use MVC\Router;
use Model\Suplemento;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class SuplementoController {
    public static function index(Router $router){
        $suplementos = Suplemento::all();
        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('admin/admin', [
            'suplementos' => $suplementos,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router){
        $suplemento = new Suplemento;
        //Arreglo con mensajes de errores 
        $errores = Suplemento::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Crea una nueva instancia con los datos enviados 
            $suplemento = new Suplemento($_POST['suplemento']);

            //Generar nombre de imagen unico 
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";

            //Procesar imagen solo si se subio
            if($_FILES['suplemento']['tmp_name']['imagen']){
                //Asignar nombre del objeto
                $suplemento->setImagen($nombreImagen);
                //crear imagen usando intervention
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['suplemento']['tmp_name']['imagen'])->cover(800, 600);
            }

            //Validar campos
            $errores = $suplemento->validar();
            
            if(empty($errores)){
                //Crear carpeta si no existe
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }

                // Guardar imagen en el servidor si fue procesada
                if (isset($imagen)) {
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }

                //Se guarda en la BD 
                $suplemento->guardar();
            }
        }

        $router->render('/suplementos/crear', [
            'suplemento' => $suplemento,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $suplemento = Suplemento::find($id);
        $errores = Suplemento::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Asignar los atributos 
            $args = $_POST['suplemento'];
            $suplemento->sincronizar($args);

            //Validacion
            $errores = $suplemento->validar();

            //Generar nombre de imagen unico 
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";

            // Declarar variable fuera del if
            $imagen = null;

            if($_FILES['suplemento']['tmp_name']['imagen']){
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['suplemento']['tmp_name']['imagen'])->cover(800, 600);
                $suplemento->setImagen($nombreImagen);
            }

            if(empty($errores)){
                if($imagen){
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $suplemento->guardar();
            }
        }

        $router->render('/suplementos/actualizar', [
            'suplemento' => $suplemento,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Validar id     
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id){
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $suplemento = Suplemento::find($id);
                    $suplemento->eliminar();
                }    
            }
        }
    }
}
