<?php
require_once "../../models/Area.php";
require_once "../../config/DataBase.php";

$area = trim($_POST['descripcion']);

$areaModel = new Area();
$areaModel->setDescripcion($area);

$response = $areaModel->existeArea();

if ($response['message'] == 'area encontrada') {
    print json_encode($response);
} else {
    $areaModel->setDescripcion($area);
    $response = $areaModel->registrarArea();
    print json_encode($response);
}


