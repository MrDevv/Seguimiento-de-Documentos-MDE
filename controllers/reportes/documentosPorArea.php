<?php
session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";

$documentoModel = new Documento();

$response = [];

$codArea = null;
$numDocumento = null;
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : null;
$registrosPorPagina = isset($_POST['registrosPorPagina']) ? $_POST['registrosPorPagina'] : null;

if ($_SESSION['user']['rol'] == 'administrador'){
    if (isset($_POST['area']) && isset($_POST['numDocumento']) && $_POST['area']!= 0){
        $codArea = $_POST['area'];
        $numDocumento = $_POST['numDocumento'];
    }else if(isset($_POST['area']) && isset($_POST['numDocumento']) && $_POST['area']== 0){
        $numDocumento = $_POST['numDocumento'];
    }else{
        $codArea = null;
        $numDocumento = null;
    }
}else if($_SESSION['user']['rol'] == 'usuario'){
    $codArea = $_SESSION['user']['codArea'];
    if(isset($_POST['numDocumento'])){
        $numDocumento = $_POST['numDocumento'];
    }
}else if($_SESSION['user']['rol'] == 'administrador área'){
    $codArea = $_SESSION['user']['codArea'];
    if(isset($_POST['numDocumento'])){
        $numDocumento = $_POST['numDocumento'];
    }
}

if($codArea && $numDocumento) {
    $response = $documentoModel->reportesPorArea((int)$codArea, $numDocumento, $pagina, $registrosPorPagina);
} else if ($codArea){
    $response = $documentoModel->reportesPorArea((int) $codArea, null, $pagina, $registrosPorPagina);
} else if ($numDocumento){
    $response = $documentoModel->reportesPorArea(null, $numDocumento, $pagina, $registrosPorPagina);
}else{
    $response = $documentoModel->reportesPorArea(null, null, $pagina, $registrosPorPagina);
}

print json_encode($response);