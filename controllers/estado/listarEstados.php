<?php
require_once "../../models/Estado.php";
require_once "../../config/DataBase.php";

$response = Estado::listarEstadosHabilitadoInhabilitado();

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);
