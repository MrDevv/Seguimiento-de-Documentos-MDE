<?php

require_once 'models/Movimiento.php';

class MovimientoController{
    public function listarMovimientos(){
        return Movimiento::listarMovimientos();
    }
}