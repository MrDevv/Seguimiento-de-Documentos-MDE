<?php
require_once "../../config/DataBase.php";
require_once "../../models/Recepcion.php";
session_start();

$pendienteRecepcionModel = new Recepcion();

$response = $pendienteRecepcionModel->listarDocumentosRecepcionados((int) $_SESSION['user']['codUsuarioArea']);

print json_encode($response);