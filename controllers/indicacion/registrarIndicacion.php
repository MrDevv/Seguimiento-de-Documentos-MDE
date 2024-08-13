<?php
require_once "../../models/Indicacion.php";
require_once "../../config/DataBase.php";

$indicacion = trim($_POST['descripcion']);

$indicacionModel = new Indicacion();
$indicacionModel->setDescripcion($indicacion);

$response = $indicacionModel->existeIndicacion();

if ($response['message'] == 'indicacion encontrada') {
    print json_encode($response);
} else {
    $indicacionModel->setDescripcion($indicacion);
    $response = $indicacionModel->registrarIndicacion();
    print json_encode($response);
}

