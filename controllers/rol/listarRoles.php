<?php
require_once "../../models/Rol.php";
require_once "../../config/DataBase.php";

$response = Rol::listarRoles();

if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);
