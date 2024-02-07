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
}