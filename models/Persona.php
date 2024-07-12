<?php

class Persona{
    private $codPersona;
    private $nombres;
    private $apellidos;
    private $telefono;
    private $dni;
    private $estado;


    public function __construct(){

    }

    public function getCodPersona(){
        return $this->codPersona;
    }

    public function setCodPersona($codPersona){
        $this->codPersona = $codPersona;
        
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function setNombres($nombres){
        $this->nombres = $nombres;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function getTelefonoo(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getDni(){
        return $this->dni;
    }

    public function setDni($dni){
        $this->dni = $dni;
    }

    public function registrarNuevaPersona(){
        $sql = "INSERT INTO Persona(nombres, apellidos, telefono, dni, codEstado) ". 
                "values(:nombres, :apellidos, :telefono, :dni, :codEstado)";

        try {
            $db = DataBase::connect();
            $stmt = $db->prepare($sql);


            $stmt->bindParam(":nombres", $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $this->apellidos, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $this->telefono, PDO::PARAM_STR);
            $stmt->bindParam(":dni", $this->dni, PDO::PARAM_STR);
            $stmt->bindParam(":codEstado", $this->estado, PDO::PARAM_INT);

            $stmt->execute();

            $idPersona = $db->lastInsertId();

            return [
                'status' => 'success',
                'message' => 'Persona registrada',
                'action' => 'registrar',
                'module' => "persona",
                'info' => ['id' => $idPersona]
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'message' => 'Ocurrio un error al momento de registrar a la persona',
                'action' => 'registrar',
                'module' => "persona",
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
        $sql = "UPDATE Persona SET nombres = :nombres, apellidos = :apellidos, telefono = :telefono, dni = :dni, codEstado = :codEstado WHERE CodPersona = :codPersona";

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