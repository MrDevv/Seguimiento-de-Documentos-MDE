<?php
require_once "../../config/DataBase.php";
require_once "../../models/TipoDocumento.php";

$tipoDocumentoModel = new TipoDocumento();

$pagina = $_GET['pagina'];
$registrosPorPagina = $_GET['registrosPorPagina'];

$response = $tipoDocumentoModel->listarTipoDocumentos($pagina, $registrosPorPagina);

print json_encode($response);