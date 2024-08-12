<?php

class Indicacion{
    private int $codIndicacion;
    private string $descripcion;

    public function getCodIndicacion(): int{
        return $this->codIndicacion;
    }

    public function setCodIndicacion(int $codIndicacion): void{
        $this->codIndicacion = $codIndicacion;
    }

    public function getDescripcion(): string{
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void{
        $this->descripcion = $descripcion;
    }

    public static function listarIndicaciones(){
        $sql = "select * from Indicacion";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }


}