<?php

require_once "models/Recepcion.php";
class RecepcionController{

    private Recepcion $recepcionModel;

    function __construct(){
        $this->recepcionModel = new Recepcion();
    }



}