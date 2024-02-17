<?php

namespace Model;


class ActiveRecord{
    //Base de datos
    protected static $db;

    //Arreglo que nos permite identificar que forma tendran los datos
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Errores 
    protected static $errores = [];

    
    public function guardar(){
        if (!is_null($this->id)) {
            //Actualizar
            $this->actualizar();
        }else{
            //Crear
            $this->crear();
        }
    }

    public function actualizar(){
        //Sanitizar los datos
        $atributos = $this -> sanitizarAtributos();
        $valores = [];

        //Mapeamos los atributos del registro a una forma mas parecida a lo que se necesita para realizar un update, que sería clave-valor
        foreach ($atributos as $key => $value) {
            $valores[]="{$key}='{$value}'";
        }

        $query= "UPDATE ".static::$tabla." SET ";
        $query .= join(', ',$valores);
        $query .= " WHERE id = '".self::$db->escape_string($this->id)."' ";
        $query .= " LIMIT 1 ";
        
        $resultado = self::$db->query($query);
        
        if ($resultado) { 
            //Redireccionar al usuario
            header('Location: /admin?resultado=2');
        }

    }

    public function crear(){
        //Sanitizar los datos
        $atributos = $this -> sanitizarAtributos();

        //Insertar en la base de datos
        $query = "INSERT INTO ".static::$tabla." ( ";
        $query.= join(', ', array_keys($atributos));
        $query.=" ) VALUES (' ";
        $query.= join("', '", array_values($atributos));
        $query.= " ')" ;
        
        $resultado = self::$db->query($query);

        //Mensaje de exito o error
        if ($resultado) { 
            //Redireccionar al usuario
            header('Location: /admin?resultado=1');
        }
    }

    //Eliminar un registro
    public function eliminar(){
        //Eliminar un registro
        $query = "DELETE FROM ".static::$tabla." WHERE id = ".self::$db->escape_string($this->id)." LIMIT 1";

        $resultado = self::$db->query($query);
        
        if ($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    //Definir la conexión con la db
    public static function setDataBase($dataBase){
        self::$db = $dataBase;
    }

    //Definimos una funcion para crear un arreglo con los atributos y los datos del objeto, esto para luego poder realizar la sanitizacion
    public function atributos(){
        $atributos = [];
        
        foreach(static::$columnasDB as $col){
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
        //Elimina la imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }

        //Asignamos al atributo imagen el nombre de la misma
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar archivos
    public function borrarImagen(){
        //Comprobamos si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES.$this->imagen);

        if($existeArchivo){
            unlink(CARPETA_IMAGENES.$this->imagen);
        }
    }

    //Validación
    public function validar(){
        static::$errores=[];
        return static::$errores;
    }

    public static function getErrores(){
        return static::$errores;
    }

    //Lista todos los registros
    public static function get($cantidad){
        $query = "SELECT * FROM ".static::$tabla. " LIMIT ".$cantidad;
        $resultado = self::consultarSQL($query);
        
        return $resultado;

    }

    //Obtener determinado numero de registros
    public static function all(){
        $query = "SELECT * FROM ".static::$tabla;
        $resultado = self::consultarSQL($query);

        return $resultado;

    }

    //Buscar una propiedad por ID
    public static function find($id){
        $query = "SELECT * FROM ".static::$tabla." WHERE id=$id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    //Funcion para consultar la db y devolver un resultado como objeto
    public static function consultarSQL($query){
        //Consultar la db
        $resultado = self::$db->query($query);

        //Iterar los resultados y formatear el resultado de arreglo a objeto
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjetos($registro); //Static para que el registro que tome sea uno de los hijos y NO la clase padre
        }

        //Liberar la memoria
        $resultado-> free();

        //Retornar los resultados ya formateados
        return $array;
    }

    protected static function crearObjetos($registro){
        $objeto = new static;

        //Toma un arreglo de resultados y crea un objeto en memoria, que es un espejo de lo que hay en la db. Así funciona activeRecords
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;        
            }
        }

        return $objeto;
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