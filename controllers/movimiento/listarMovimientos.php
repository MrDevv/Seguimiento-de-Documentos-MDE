<?php
require_once "../../config/DataBase.php";
require_once "../../models/Movimiento.php";

$movimientoModel = new Movimiento();

$response = Movimiento::listarMovimientos();

print json_encode($response);