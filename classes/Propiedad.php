<?php 

namespace App;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';

    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen','descripcion','habitaciones','banios', 'estacionamiento', 'fechaCreacion', 'vendedores_id'];

    //Atributos
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $banios;
    public $estacionamiento;
    public $fechaCreacion;
    public $vendedores_id;

    //Constructor
    public function __construct($args = []){
        $this -> id = $args['id'] ?? NULL;
        $this -> titulo = $args['titulo'] ?? '';
        $this -> precio = $args['precio'] ?? '';
        $this -> imagen = $args['imagen'] ?? '';
        $this -> descripcion = $args['descripcion'] ?? '';
        $this -> habitaciones = $args['habitaciones'] ?? '';
        $this -> banios = $args['banios'] ?? '';
        $this -> estacionamiento = $args['estacionamiento'] ?? '';
        $this -> fechaCreacion = date('Y/m/d');
        $this -> vendedores_id = $args['vendedores_id'] ?? '';
    }


    public function validar(){
        //Verificacion de errores
        if (!$this->titulo){
            self::$errores[] = 'Debes añadir un titulo';
        }

        if (!$this->precio) {
            self::$errores[] = 'El Precio es obligatorio';
        }

        if (!$this->imagen) {
            self::$errores[] = 'La imagen es obligatoria';
        }
        
        if (strlen($this->descripcion)<50) {
            self::$errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if (!$this->habitaciones) {
            self::$errores[] = 'El numero de habitaciones es obligatorio';
        }

        if (!$this->banios) {
            self::$errores[] = 'El numero de banios es obligatorio';
        }

        if (!$this->estacionamiento) {
            self::$errores[] = 'El numero de lugares de estacionamientos es obligatorio';
        }

        if (!$this->vendedores_id ) {
            self::$errores[] = 'Debes seleccionar un vendedor';
        }

        return self::$errores;
    }
}