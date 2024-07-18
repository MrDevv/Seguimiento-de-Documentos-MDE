<?php

class DataBase{
    // Variables para my sql
    private static $serverNameMySql = "monorail.proxy.rlwy.net";
    private static $databaseMySql = "railway";
    private static $usernameMySql = "root";
    private static $passwordMySql = "ieEQptuHBRhLWJfpBUDdVfXgboUPzTda";
    private static $portMySql = "40079";

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


/*
$serverName = "localhost"; // o el nombre/IP del servidor SQL Server
$connectionOptions = array(
    "Database" => "Sistema_Seguimiento_Documentos", // Nombre de la base de datos
    "Uid" => "sa", // Usuario
    "PWD" => "admin" // Contraseña
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Verificar si la conexión se estableció correctamente
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Conexión exitosa.";
}

return $conn;
*/