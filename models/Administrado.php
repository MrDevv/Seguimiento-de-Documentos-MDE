<?php

class Administrado{
    private $Nombre;
    private $Area;
    private $Apellidos;
    private $Estado;
    private $Telefono;

    private $Usuario;
    private $Contrasenia;

    public function __construct(){

    }

    public function getNombre(){
        return $this->Nombre;
    }

    public function setNombre($nombre){
        $this->Nombre = $Nombre;
    }

    public function getArea(){
        return $this->Area;
    }

    public function setArea($area){
        $this->Area = $Area;
    }

    public function getApellidos(){
        return $this->Apellidos;
    }

    public function setApellidos($apellidos){
        $this->Apellidos = $Apellidos;
    }

    public function getEstado(){
        return $this->Estado;
    }

    public function setEstado($estado){
        $this->Estado = $Estado;
    }

    public function getTelefonoo(){
        return $this->Telefono;
    }

    public function setTelefono($telefono){
        $this->Telefono = $Telefono;
    }

    public function getUsuario(){
        return $this->Usuario;
    }

    public function setUsuario($usuario){
        $this->Uusuario = $Usuario;
    }

    public function getContrasenia(){
        return $this->Contrasenia;
    }

    public function setContrasenia($contrasenia){
        $this->Contrasenia = $Contrasenia;
    }

    public function registrarNuevoAdministrado(){
        $sql = "#";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
    }

    public function editar(){
        if (isset($_GET["cod"])){
            $codAdmiistrado = $_GET['cod'];

            var_dump($codAdministrado);
            require_once "views/administrado/editarAdministrado.php";
        }else{
//            Redirecciona a la vista de listado
            $this->redirect();
        }
        
    }

    public function listarAdministrado(){
        $sql = "SELECT  a.codAdministrado, a.nombres, a.apellidos, a.telefono, ar.descripcion AS area, e.descripcion AS estado ".
                "FROM Administrado a ".
                "JOIN Area ar ON a.codArea = ar.codArea ".
                "JOIN Estado e ON a.codEstado = e.codEstado; ";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /*$stmt = DataBase::connect()->query($sql);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results; */

}