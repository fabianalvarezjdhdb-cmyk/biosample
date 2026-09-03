<?php
class Responsable {
    private string $cedula;
    private string $nombreCompleto;
    private string $laboratorio;

    public function __construct(string $cedula, string $nombreCompleto, string $laboratorio) {
        $this->cedula = $cedula;
        $this->nombreCompleto = $nombreCompleto;
        $this->laboratorio = $laboratorio;
    }

    public function getCedula(): string {
        return $this->cedula;
    }

    public function getNombreCompleto(): string {
        return $this->nombreCompleto;
    }

    public function getLaboratorio(): string {
        return $this->laboratorio;
    }
}
