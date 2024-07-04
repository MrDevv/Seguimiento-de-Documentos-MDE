<?php

class Persona{
    private $codPersona;
    private $Nombre;
    private $Apellidos;
    private $Telefono;
    private $Dni;
    private $Estado;


    public function __construct(){

    }

    public function getCodPersona(){
        return $this->CodPersona;
    }

    public function setCodPersona($codPersona){
        $this->codPersona = $codPersona;
        
    }

    public function getNombre(){
        return $this->Nombre;
    }

    public function setNombre($nombre){
        $this->Nombre = $Nombre;
    }

    public function getApellidos(){
        return $this->Apellidos;
    }

    public function setApellidos($apellidos){
        $this->Apellidos = $Apellidos;
    }

    public function getTelefonoo(){
        return $this->Telefono;
    }

    public function setTelefono($telefono){
        $this->Telefono = $Telefono;
    }

    public function getEstado(){
        return $this->Estado;
    }

    public function setEstado($estado){
        $this->Estado = $Estado;
    }

    public function getDni(){
        return $this->Dni;
    }

    public function setDni($dni){
        $this->Dni = $Dni;
    }

    public function registrarNuevaPersona(){
        $sql = "INSERT INTO Persona(codPersona, nombres, apellidos, telefono, dni, codEstado) 
        values(:codPersona, :nombres, :apellidos, :telefono, :dni, :codEstado)";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":codPersona", $this->codPersona, PDO::PARAM_STR);
            $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $this->apellidos, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $this->telefono, PDO::PARAM_STR);
            $stmt->bindParam(":dni", $this->dni, PDO::PARAM_STR);
            $stmt->bindParam(":codEstado", $this->codEstado, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Persona registrada',
                'action' => 'registrar'
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar a la persona',
                'action' => 'registrar',
                'info' => $e->getMessage()
            ];
        }
    }

    public function buscarPersona(){
        $sql = "SELECT * FROM Persona WHERE CodPersona = :codPersona";
        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":codPersona", $this->codPersona, PDO::PARAM_INT);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (sizeof($results) == 0){
                return [
                    'status' => 'not found',
                    'message' => 'No existe una persona con este código',
                    'action' => 'buscar'
                ];
            }

            return $results;

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar a la persona',
                'action' => 'buscar',
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarPersona(){
        $sql = "UPDATE Persona SET nombre = :nombre, apellidos = :apellidos, telefono = :telefono, dni = :dni, codEstado = :codEstado WHERE CodPersona = :codPersona";

        try {
            $stmt = DataBase::connect()->prepare($sql);

            $stmt->bindParam(":codPersona", $this->codPersona, PDO::PARAM_STR);
            $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $this->apellidos, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $this->telefono, PDO::PARAM_STR);
            $stmt->bindParam(":dni", $this->dni, PDO::PARAM_STR);
            $stmt->bindParam(":codEstado", $this->codEstado, PDO::PARAM_STR);

            $stmt->execute();

            return [
                'status' => 'success',
                'message' => 'Persona actualizada',
                'action' => 'actualizar'
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de actualizar a la persona',
                'action' => 'actualizar',
                'info' => $e->getMessage()
            ];
        }
    }

    /*$stmt = DataBase::connect()->query($sql);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results; */

}