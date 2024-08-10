<?php
require_once "../../config/DataBase.php";
require_once "../../models/Area.php";

$areaModel = new Area();

$response = $areaModel->obtenerTotalAreasRegistradas();

print json_encode($response);