<?php
namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    //Constructor
    public function __construct($args = [])
    {
        $this -> id = $args['id'] ?? NULL;
        $this -> nombre = $args['nombre'] ?? '';
        $this -> apellido = $args['apellido'] ?? '';
        $this -> telefono = $args['telefono'] ?? '';

    }

    public function validar(){
        //Verificacion de errores
        if (!$this->nombre){
            self::$errores[] = 'Debes añadir un nombre';
        }
        if (!$this->apellido){
            self::$errores[] = 'Debes añadir un apellido';
        }

        if (!$this->telefono){
            self::$errores[] = 'Debes añadir un teléfono';
        }

        //Validamos que solo ingresen caracteres numericos mediante una expresión regular.
        //'/[0-9]{10}/' solo se permiten numeros del 0 al 9 y el tiene que tener una longitud de 10
        if (!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = 'El número de telefono debe contener unicamente caracteres numéricos y una longitud de 10';
        }



        return self::$errores;
    }


}