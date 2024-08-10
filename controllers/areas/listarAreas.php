<?php
require_once "../../models/Area.php";
require_once "../../config/DataBase.php";

$areaObj = new Area();

$pagina = $_GET['pagina'];
$registrosPorPagina = $_GET['registrosPorPagina'];

$response = $areaObj->listarArea($pagina, $registrosPorPagina);

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);
