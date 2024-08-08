<?php
session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";

$documentoModel = new Documento();

$response = [];

$codArea = null;
$numDocumento = null;

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
    $response = $documentoModel->reportesPorArea((int)$codArea, $numDocumento);
} else if ($codArea){
    $response = $documentoModel->reportesPorArea((int) $codArea, null);
} else if ($numDocumento){
    $response = $documentoModel->reportesPorArea(null, $numDocumento);
}else{
    $response = $documentoModel->reportesPorArea();
}

print json_encode($response);