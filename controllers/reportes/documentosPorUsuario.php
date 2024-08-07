<?php
session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";

$documentoModel = new Documento();

$response = [];

$numDocumento = null ;
$codUsuario = null;
$codArea = null;

if ($_SESSION['user']['rol'] == 'administrador'){
    if (isset($_POST['usuario']) && isset($_POST['numDocumento']) && $_POST['usuario']!= 0){
        $codUsuario = $_POST['usuario'];
        $numDocumento = $_POST['numDocumento'];
    }else if(isset($_POST['usuario']) && isset($_POST['numDocumento']) && $_POST['usuario']== 0){
        $numDocumento = $_POST['numDocumento'];
    }
}else if ($_SESSION['user']['rol'] == 'administrador área'){
    $codArea = $_SESSION['user']['codArea'];
    if (isset($_POST['usuario']) && isset($_POST['numDocumento']) && $_POST['usuario']!= 0){
        $codUsuario = $_POST['usuario'];
        $numDocumento = $_POST['numDocumento'];
    }else if(isset($_POST['usuario']) && isset($_POST['numDocumento']) && $_POST['usuario']== 0){
        $numDocumento = $_POST['numDocumento'];
    }
} else if($_SESSION['user']['rol'] == 'usuario'){
    $codUsuario = $_SESSION['user']['codUsuarioArea'];
    if(isset($_POST['numDocumento'])){
        $numDocumento = $_POST['numDocumento'];
    }
}

if($codUsuario && $numDocumento) {
    $response = $documentoModel->reportesPorUsuario($codArea, $numDocumento,(int) $codUsuario);
} else if ($numDocumento){
    $response = $documentoModel->reportesPorUsuario($codArea, $numDocumento, null);
}else if ($codUsuario){
    $response = $documentoModel->reportesPorUsuario($codArea, null, $codUsuario);
}else{
    $response = $documentoModel->reportesPorUsuario($codArea);
}

print json_encode($response);