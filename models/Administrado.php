<?php

class Administrado{
    private $codAdmistrado;
    private $Nombre;
    private $Area;
    private $Apellidos;
    private $Estado;
    private $Telefono;
    private $codUsuario;


    public function __construct(){

    }

    public function getCodAdministrado(){
        return $this->getCodAdministrado;
    }

    public function setCodAdministrado($codAdministrado){
        $this->codAdministrado = $codAdministrado;
        
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

    public function getCodUsuario(){
        return $this->Usuario;
    }

    public function setCodUsuario($codUsuario){
        $this->CodUsuario = $codUsuario;
    }


    public function registrarNuevoAdministrado(){
        $sql = "INSERT INTO Administrado(codAdministrado, nombres, codArea, apellidos, codEstado, telefono, codUsuario) 
        values(:codAdministrado, :nombres, :codArea, :apellidos, :codEstado, :telefono, :codUsuario)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":codAdministrado", $this->codAdministrado, PDO::PARAM_STR);
            $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam(":codArea", $this->codArea, PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $this->apellidos, PDO::PARAM_STR);
            $stmt->bindParam(":codEstado", $this->codEstado, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $this->telefono, PDO::PARAM_STR);
            $stmt->bindParam(":codUsuario", $this->codUsuario, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Administrado registrado',
                'action' => 'registrar'
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el Administrado',
                'action' => 'registrar',
                'info' => $e->getMessage()
            ];
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

    public function buscarAdministrado(){
        $sql = "SELECT * FROM Administrado WHERE CodAdministrado = :codAdministrado";
        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":codAdministrado", $this->codAdministrado, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (sizeof($results) == 0){
                return [
                    'status' => 'not found',
                    'message' => 'No existe una Area con este código',
                    'action' => 'buscar'
                ];
            }

            return $results;

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar el administrado',
                'action' => 'buscar',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarAdministrado(){
        $sql = "UPDATE Administrado SET nombre = :nombre, codArea = :codArea, apellidos = :apellidos, codEstado = :codEstado, telefono = :telefono, codUsuario = :codUsuario WHERE CodAdministrado = :codAdministrado";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":codAdministrado", $this->codAdministrado, PDO::PARAM_STR);
            $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam(":codArea", $this->codArea, PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $this->apellidos, PDO::PARAM_STR);
            $stmt->bindParam(":codEstado", $this->codEstado, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $this->telefono, PDO::PARAM_STR);
            $stmt->bindParam(":codUsuario", $this->codUsuario, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Administrado actualizada',
                'action' => 'actualizar'
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar el administrado',
                'action' => 'actualizar',
                'info' => $e->getMessage()
            ];
        }
    }





    /*$stmt = DataBase::connect()->query($sql);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results; */

}