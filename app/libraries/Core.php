<?php

/**
 * Core.php
 *
 * Carga el controlador que viene en el primer parámetro
 * Si no se especifíca, se carga el default: "Paginas"
 * Ejemplo: /controlador/método/parámetros
 * 
 */
class Core{
    protected $controladorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct(){
        $url = $this->getURL();     // $url[0] = controlador    

        if($url && file_exists('../app/controllers/'. ucwords($url[0]. '.php'))){
            $this->controladorActual = ucwords($url[0]);
            unset($url[0]);
        }

        require_once '../app/controllers/'.$this->controladorActual.'.php';

        $this->controladorActual = new $this->controladorActual();

        if(isset($url[1])){  //$url[1]=método, 
            if(method_exists($this->controladorActual, $url[1])){
                $this->metodoActual = $url[1];
                unset($url[1]);
            }
        }
        
        $this->parametros = $url ? array_values($url) : []; // $url[2]=parámetros
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros); //callback
    }

    public function getURL(){

        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);
        }else{
            $url = array('Paginas');
        }
        return $url;
    }
}

?>
