<?php

class DataBase{
    private static $serverName = "dpg-cq8knjd6l47c73cvt5og-a";
    private static $port = '5432';
    private static $database = "Sistema_Seguimiento_Documentos";
    private static $username = "sa";
    private static $password = "UH4PXMCBRau2Uv87u7dX7YHjUDdByJFe";
    public static function connect(){
        try {
            //$conn = new PDO("sqlsrv:server=" . self::$serverName . ";port=". self::$port . ";Database=" . self::$database, self::$username, self::$password);
            $conn = new PDO("postgresql://sa:UH4PXMCBRau2Uv87u7dX7YHjUDdByJFe@dpg-cq8knjd6l47c73cvt5og-a.oregon-postgres.render.com/sistema_seguimiento_documentos");
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