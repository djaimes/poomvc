<?php

/**
 * Clase PDO para 12 bases de datos
 */

class Database{
    
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh;   // Database Handler
    private $stmt;  // Sentencia SQL (statement)
    private $error;     // Cachar error

    public function __construct(){
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;

        $options = array(
            PDO::ATTR_PERSISTENT =>true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Crear una instancia a la base de datos
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);    
        }catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    // Preparar Query
    public function query($SQL){
        $this->stmt = $this->dbh->prepare($SQL);
    }

    // Asociar valores
    public function bind($param, $value, $type=null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_int($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_int($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Ejecutar el query
    public function execute(){
        return $this->stmt->execute();
    }

    // Obtener el resultado como matriz de objetos
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Obtener un registro como objeto
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Obtener el contador de filas retornadas
    public function rowCount(){
        $this->execute();
        return $this->stmt->rowCount();
    }
}
?>