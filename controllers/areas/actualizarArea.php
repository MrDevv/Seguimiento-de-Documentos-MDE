<?php
require_once "../../models/Area.php";
require_once "../../config/DataBase.php";

$codArea = trim($_POST['codArea']);
$area = trim($_POST['descripcion']);


$areaModel = new Area();
$areaModel->setCodArea($codArea);
$areaModel->setDescripcion($area);

$response = $areaModel->existeArea();

if ($response['message'] == 'area encontrada'){
    print json_encode($response);
}else{
    $areaModel->setCodArea($codArea);
    $areaModel->setDescripcion($area);
    $response = $areaModel->actualizarArea();
    print json_encode($response);
}
