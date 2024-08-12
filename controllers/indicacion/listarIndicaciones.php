<?php
require_once "../../config/DataBase.php";
require_once "../../models/Indicacion.php";

$indicacionModel = new Indicacion();

$response = Indicacion::listarIndicaciones();

print json_encode($response);