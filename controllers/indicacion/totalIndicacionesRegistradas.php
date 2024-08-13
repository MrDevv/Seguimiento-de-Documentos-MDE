<?php
require_once "../../config/DataBase.php";
require_once "../../models/Indicacion.php";

$indicacionModel = new Indicacion();

$response = $indicacionModel->obtenerTotalIndicacionesRegistradas();

print json_encode($response);