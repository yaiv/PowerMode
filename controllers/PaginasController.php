<?php

namespace Controllers;
use MVC\Router;
use Model\Prenda;
use Model\Suplemento;


class PaginasController {
    public static function index ( Router $router ){
        $prendas = Prenda::get(4);
        $suplementos = Suplemento::get(4);
        $inicio = true;

        $router->render('paginas/index', [
            'prendas' => $prendas,
            'suplementos' => $suplementos,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros ( Router $router ){

        $router->render('paginas/nosotros');
    }

        public static function prendas ( Router $router ){

            $prendas = Prenda::all();

            $router->render('paginas/prendas',[
                'prendas' => $prendas
    
            ]);
    }

        public static function prenda ( Router $router ){
        
        $id = validarORedireccionar('/prendas');

                //Buscar la prenda por su id 
                $prenda = Prenda::find($id);
                $router->render('paginas/prenda', [
                    'prenda' => $prenda
                ]);

    }

        public static function suplementos ( Router $router ){
        $suplementos = Suplemento::all();

        $router->render('paginas/suplementos', [
            'suplementos' => $suplementos
        ]);
    }

        public static function suplemento ( Router $router ){
        $id = validarORedireccionar('/suplementos');

        //Buscar el suplemento por su id 
        $suplemento = Suplemento::find($id);
        $router->render('paginas/suplemento', [
            'suplemento' => $suplemento
        ]);
    }

}