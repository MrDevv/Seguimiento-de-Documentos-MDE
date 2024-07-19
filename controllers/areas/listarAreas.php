<?php
require_once "../../models/Area.php";
require_once "../../config/DataBase.php";

$areaObj = new Area();
$response = $areaObj->listarArea();


if ($response > 0){
    $data = $response;
}else{
    $data = null;
}

print json_encode($data);
