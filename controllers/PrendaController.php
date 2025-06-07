<?php 

namespace Controllers;
use MVC\Router;
use Model\Prenda;
use Model\Suplemento;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class PrendaController {
    public static function index(Router $router){
        $prendas = Prenda::all();
        $suplementos = Suplemento::all();
        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('admin/admin', [
            'prendas' => $prendas,
            'suplementos' => $suplementos,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router){
        $prenda = new Prenda; 
        //Arreglo con mensajes de errores 
        $errores = Prenda::getErrores();

//Ejecuta el codigo despues de que el usuario envia el formulario 
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //Crea una nueva instancia con los datos enviados 
    $prenda = new Prenda($_POST['prenda']); // ← Cambiado aquí
    //debuguear($prenda);

     // Convertir array de tallas a una cadena separada por comas
    $prenda->tallas = isset($_POST['prenda']['tallas']) ? implode(",", $_POST['prenda']['tallas']) : '';

    //Generar nombre de imagen unico 
    $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";

    //Procesar imagen solo si se subio
    if($_FILES['prenda']['tmp_name']['imagen']){ // ← Cambiado aquí
        //Asignar nombre del objeto
        $prenda->setImagen($nombreImagen);
        //crear imagen usando intervention
        $manager = new Image(Driver::class);
        $imagen = $manager->read($_FILES['prenda']['tmp_name']['imagen'])->cover(800, 600); // ← Cambiado aquí
    }

    //Validar campos
    $errores = $prenda->validar();
    
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
        $prenda->guardar();
    }
}


 
        $router->render('/prendas/crear', [
            'prenda' => $prenda,
            'errores' => $errores
        ]);

    }


    public static function actualizar(Router $router){
        
        $id = validarORedireccionar('/admin');
        $prenda = Prenda::find($id);



        $errores = Prenda::getErrores();


        if($_SERVER['REQUEST_METHOD'] === 'POST'){

   // debuguear($_POST);

   //Asignar los atributos 
    $args = $_POST['prenda'];

    // Convertir array de tallas a una cadena separada por comas
    $args['tallas'] = isset($_POST['prenda']['tallas']) ? implode(",", $_POST['prenda']['tallas']) : '';

    $prenda->sincronizar($args);

    //Validacion
    $errores = $prenda->validar();

    //Subida de archivos 

    //Generar nombre de imagen unico 
    $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";

     // Declarar variable fuera del if
    $imagen = null;

    if($_FILES['prenda']['tmp_name']['imagen']){
    $manager = new Image(Driver::class); //Configuracion Driver
    $imagen = $manager->read($_FILES['prenda']['tmp_name']['imagen'])->cover(800, 600); //Se leer la imagen y se le realiza una transformacion
    $prenda->setImagen($nombreImagen);
        }
    //En caso de que no haya errores guardar 
    if(empty($errores)){
        //Almacenar la imagen 
        if($imagen){
        $imagen->save(CARPETA_IMAGENES . $nombreImagen);
        }
        $prenda->guardar();
    }
}


        $router->render('/prendas/actualizar', [
            'prenda' => $prenda,
            'errores' => $errores
        ]);
    }



    public static function eliminar(){
        //El post no va a existir hasta que se me mande el request medhod 
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
                //Validar id     
                 $id = $_POST['id'];
                 $id = filter_var($id, FILTER_VALIDATE_INT);
                
                 if($id){
                     $tipo = $_POST['tipo'];
                    if(validarTipoContenido($tipo)){
                        $prenda = Prenda::find($id);
                        $prenda->eliminar();
                   }    
                 }
           }
        
        }

}
