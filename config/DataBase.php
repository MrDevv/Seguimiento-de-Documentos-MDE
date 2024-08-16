<?php

class DataBase{
    // variables para sql server
    private static $serverName = "localhost";
    private static $database = "Sistema_Seguimiento_Documentos";
    private static $username = "sa";
    private static $password = "admin";
    public static function connect(){
        try {
            $conn = new PDO("sqlsrv:server=" . self::$serverName . ";Database=" . self::$database, self::$username, self::$password);
            //$conn = new PDO("mysql:host=".self::$serverNameMySql.";port=". self::$portMySql .";dbname=". self::$databaseMySql.";", self::$usernameMySql, self::$passwordMySql);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}