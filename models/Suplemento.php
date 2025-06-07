<?php 

namespace Model;

use Intervention\Image\Colors\Hsv\Channels\Value;

//Se va a tulizar active record, es el responsable de trabajar con datos

class Suplemento extends ActiveRecord {

        protected static $tabla = 'suplementos';
            //Arrelo que permite mapear en crear.php
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'marca', 'tipo', 'creado'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $marca;
    public $tipo;
    public $creado;

            public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->marca = $args['marca'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->creado = date('Y/m/d');
    }

     public function validar(){
            //Mensajes de error 
    if(!$this->titulo) {
        self::$errores[] = "El nombre del producto es obligatorio";
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
       
    if(!$this->tipo) {
        self::$errores[] = "Debes colocar el tipo de suplemento";
    }

    //validacion imagen obligatoria
    if(!$this->imagen){
        self::$errores[] = 'La imagen es obligatoria';
    }



    return self::$errores;
    }

}