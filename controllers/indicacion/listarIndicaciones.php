<?php
require_once "../../config/DataBase.php";
require_once "../../models/Indicacion.php";

$indicacionModel = new Indicacion();

$pagina = $_GET['pagina'];
$registrosPorPagina = $_GET['registrosPorPagina'];

$response = $indicacionModel->listarIndicaciones($pagina, $registrosPorPagina);

print json_encode($response);