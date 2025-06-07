<?php 

namespace Model;

use Intervention\Image\Colors\Hsv\Channels\Value;

//Se va a tulizar active record, es el responsable de trabajar con datos

class Prenda extends ActiveRecord {

        protected static $tabla = 'prendas';
            //Arrelo que permite mapear en crear.php
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'marca', 'color', 'tallas', 'creado'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $marca;
    public $color;
    public $tallas;
    public $creado;
    

            public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->marca = $args['marca'] ?? '';
        $this->color = $args['color'] ?? '';
        $this->tallas = $args['tallas'] ?? '';
        $this->creado = date('Y/m/d');
    }

     public function validar(){
            //Mensajes de error 
    if(!$this->titulo) {
        self::$errores[] = "El titulo es obligatorio";
    }

    if(!$this->precio) {
        self::$errores[] = "El precio es obligatorio";
    }

    if( strlen ($this->descripcion) < 30) {
        self::$errores[] = "Debes colocar una descripcion de al menos 30 carcteres";
    }

    if(!$this->marca) {
        self::$errores[] = "Debes de colcar la marca de manera obligatoria";
    }
       
    if(!$this->color) {
        self::$errores[] = "El color es obligatorio";
    }
    if(!$this->tallas) {
        self::$errores[] = "La talla es obligatoria";
    }

    //validacion imagen obligatoria
    if(!$this->imagen){
        self::$errores[] = 'La imagen es obligatoria';
    }



    return self::$errores;
    }

}