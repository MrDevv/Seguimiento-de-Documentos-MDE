<?php

class UsuarioArea{
    private $Usuario;
    private $Area;

    public function getUsuario(){
        return $this->Usuario;
    }

    public function setUsuario($Usuario): void{
        $this->Usuario = $Usuario;
    }

    public function getArea(){
        return $this->Area;
    }

    public function setArea($Area): void{
        $this->Area = $Area;
    }


}