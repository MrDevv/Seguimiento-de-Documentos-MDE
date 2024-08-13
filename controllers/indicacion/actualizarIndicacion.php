<?php
require_once "../../models/Indicacion.php";
require_once "../../config/DataBase.php";

$codIndicacion = trim($_POST['codIndicacion']);
$indicacion = trim($_POST['descripcion']);


$indicacionModel = new Indicacion();
$indicacionModel->setDescripcion($indicacion);

$response = $indicacionModel->existeIndicacion();

if ($response['message'] == 'indicacion encontrada'){
    print json_encode($response);
}else{
    $indicacionModel->setCodIndicacion($codIndicacion);
    $indicacionModel->setDescripcion($indicacion);
    $response = $indicacionModel->actualizarIndicacion();
    print json_encode($response);
}
