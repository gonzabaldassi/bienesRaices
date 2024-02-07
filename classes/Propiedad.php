<?php 

namespace App;

class Propiedad{

    //Base de datos
    protected static $db;

    //Arreglo que nos permite identificar que forma tendran los datos
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen','descripcion','habitaciones','banios', 'estacionamiento', 'fechaCreacion', 'vendedores_id'];

    //Errores 
    protected static $errores = [];
    
    private $id;
    private $titulo;
    private $precio;
    private $imagen;
    private $descripcion;
    private $habitaciones;
    private $banios;
    private $estacionamiento;
    private $fechaCreacion;
    private $vendedores_id;

    public function __construct($args = [])
    {
        $this -> id = $args['id'] ?? '';
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

    public function guardar(){

        //Sanitizar los datos
        $atributos = $this -> sanitizarAtributos();


        //Insertar en la base de datos
        $query = "INSERT INTO propiedades ( ";
        $query.= join(', ', array_keys($atributos));
        $query.=" ) VALUES (' ";
        $query.= join("', '", array_values($atributos));
        $query.= " ')" ;
        
        $resultado = self::$db->query($query);

        return $resultado;
    }

    //Definir la conexión con la db
    public static function setDataBase($dataBase){
        self::$db = $dataBase;
    }

    //Definimos una funcion para crear un arreglo con los atributos y los datos del objeto, esto para luego poder realizar la sanitizacion
    public function atributos(){
        $atributos = [];
        foreach(self::$columnasDB as $col){

            if ($col === 'id') continue;
            $atributos[$col] = $this -> $col; 
        }

        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this -> atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key]= self::$db -> escape_string($value);
        }

        return $sanitizado;
    }

    //Subida de archivos

    public function setImagen($imagen){
        //Asignamos al atributo imagen el nombre de la misma
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Validación
    public static function getErrores(){
        return self::$errores;
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

    //Lista toda las propiedades
    public static function all(){
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);

        return $resultado;

    }
    //Buscar una propiedad por ID
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id=$id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        //Consultar la db
        $resultado = self::$db->query($query);

        //Iterar los resultados y formatear el resultado de arreglo a objeto
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjetos($registro);
        }

        //Liberar la memoria
        $resultado-> free();

        //Retornar los resultados ya formateados
        return $array;
    }

    protected static function crearObjetos($registro){
        $objeto = new self;

        //Toma un arreglo de resultados y crea un objeto en memoria, que es un espejo de lo que hay en la db. Así funciona activeRecords
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
                
            }
        }

        return $objeto;
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

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getEstacionamiento(){
        return $this->estacionamiento;
    }

    public function getBanios(){
        return $this->banios;
    }
    
    public function getHabitaciones(){
        return $this->habitaciones;
    }

    public function getVendedores(){
        return $this->vendedores_id;
    }

    //Sincronizar el objeto en memoria con los cambios realizados por el usuario
    //Leemos el post y actualizamos el objeto en memoria, aplicamos un principio de active record
    public function sincronizar($args = []){
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key=$value;
            }
        }

    }
}