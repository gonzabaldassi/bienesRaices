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

    //Getter del ID
    public function getID(){
        return $this->id;
    }

    //Getter del Titulo
    public function getTitulo(){
        return $this->titulo;
    }

    //Getter de la imagen
    public function getImagen(){
        return $this->imagen;
    }

    //Getter del precio
    public function getPrecio(){
        return $this->precio;
    }

    //Getter de la descripcion
    public function getDescripcion(){
        return $this->descripcion;
    }

    //Getter del estacionamiento
    public function getEstacionamiento(){
        return $this->estacionamiento;
    }

    //Getter de los wc
    public function getBanios(){
        return $this->banios;
    }
    
    //Getter de las habitaciones
    public function getHabitaciones(){
        return $this->habitaciones;
    }

    //Getter del id del vendedor
    public function getVendedores(){
        return $this->vendedores_id;
    }
}