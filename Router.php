<?php 

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get ($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    public function post ($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){


        session_start();
        $auth = $_SESSION['login'] ?? null;

        //Arreglo de rutas protegidas

        $rutas_protegidas = ['/admin', '/prendas/crear', '/prendas/actualizar', '/prendas/eliminar', '/suplementos/crear', '/suplementos/actualizar', '/suplementos/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }


        //Proteger la rutas 

        if(in_array($urlActual, $rutas_protegidas) && !$auth){
            header('Location: /');

        }


        if($fn){
            //La URL existe y hay una funcion asociada

            call_user_func($fn, $this);
        }else{
            echo "Pagina no encontrada";
        }
    }

    
    //Muestra como una vista 

    public function render($view, $datos = []){
        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start(); //inicia el almanecemiento en memeoria 

        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();  //limpiamos lo que esta en la memoria 

        include_once __DIR__ . "/views/layout.php";
    }
}