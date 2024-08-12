<?php
session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";

$documentoModel = new Documento();

$response = [];

$codArea = null;
$numDocumento = null;

if ($_SESSION['user']['rol'] == 'administrador'){
    if (isset($_GET['area']) && isset($_GET['numDocumento']) && $_GET['area']!= 0){
        $codArea = $_GET['area'];
        $numDocumento = $_GET['numDocumento'];
    }else if(isset($_GET['area']) && isset($_GET['numDocumento']) && $_GET['area']== 0){
        $numDocumento = $_GET['numDocumento'];
    }else{
        $codArea = null;
        $numDocumento = null;
    }
}else if($_SESSION['user']['rol'] == 'usuario'){
    $codArea = $_SESSION['user']['codArea'];
    if(isset($_GET['numDocumento'])){
        $numDocumento = $_GET['numDocumento'];
    }
}else if($_SESSION['user']['rol'] == 'administrador área'){
    $codArea = $_SESSION['user']['codArea'];
    if(isset($_GET['numDocumento'])){
        $numDocumento = $_GET['numDocumento'];
    }
}

if($codArea && $numDocumento) {
    $response = $documentoModel->totalDocumentosPorAreaReporte((int)$codArea, $numDocumento);
} else if ($codArea){
    $response = $documentoModel->totalDocumentosPorAreaReporte((int) $codArea, null);
} else if ($numDocumento){
    $response = $documentoModel->totalDocumentosPorAreaReporte(null, $numDocumento);
}else{
    $response = $documentoModel->totalDocumentosPorAreaReporte();
}

print json_encode($response);