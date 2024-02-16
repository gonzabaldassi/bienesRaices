<?php

namespace Model;

class Admin extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','email','password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args=[]){
        $this->id=$args['id'] ?? null;
        $this->email=$args['email'] ?? null;
        $this->password=$args['password'] ?? null;
    }

    public function validar(){
        if(!$this->email){
            self::$errores[]="El email es obligatorio";
        }
        if(!$this->password){
            self::$errores[]="El password es obligatorio";
        }
        return self::$errores;
    }

    public function existeUsuario(){
        //Controlar si el user existe o no
        $query = "SELECT * FROM ".self::$tabla." WHERE email= '".$this->email. "' LIMIT 1";

        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[]="El usuario es incorrecto";
            return;
        }

        return $resultado;
    }

    public function validarPassword($resultado){
        $usuario = $resultado->fetch_object();

        //Verificar si el password es correcto o no
        $auth=password_verify($this->password, $usuario->password);

        if (!$auth) {
            self::$errores[]="El password es incorrecto";
        }

        return $auth;
    }

    public function autenticar(){
        //Guardar que el usuario fue autenticado
        session_start();

        //Llenar el arreglo de sesion
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}