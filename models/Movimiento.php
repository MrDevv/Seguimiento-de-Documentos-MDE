<?php

class Movimiento{
    private int $codMovimiento;
    private string $descripcion;

    public function getCodMovimiento(): int{
        return $this->codMovimiento;
    }

    public function setCodMovimiento(int $codMovimiento): void{
        $this->codMovimiento = $codMovimiento;
    }

    public function getDescripcion(): string{
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void{
        $this->descripcion = $descripcion;
    }

    public static function listarMovimientos(){
        $sql = "select * from movimiento";

        $stmt = DataBase::connect()->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }


}