<?php

require_once 'models/Indicacion.php';

class MovimientoController{
    public function listarMovimientos(){
        return Indicacion::listarIndicaciones();
    }
}