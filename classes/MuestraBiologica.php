<?php
class MuestraBiologica {
    private string $codigo;
    private TipoMuestra $tipoMuestra;      // Relación de agregación/composición
    private string $procedencia;
    private string $fechaRecoleccion;
    private Responsable $responsable;    // Relación de agregación/composición
    private string $estado;              // 'Almacenada', 'En Proceso', 'Analizada', 'Descartada'

    public function __construct(string $codigo, TipoMuestra $tipoMuestra, string $procedencia, string $fechaRecoleccion, Responsable $responsable, string $estado) {
        $this->codigo = $codigo;
        $this->tipoMuestra = $tipoMuestra;
        $this->procedencia = $procedencia;
        $this->fechaRecoleccion = $fechaRecoleccion;
        $this->responsable = $responsable;
        $this->estado = $estado;
    }

    // Getters
    public function getCodigo(): string { return $this->codigo; }
    public function getTipoMuestra(): TipoMuestra { return $this->tipoMuestra; }
    public function getProcedencia(): string { return $this->procedencia; }
    public function getFechaRecoleccion(): string { return $this->fechaRecoleccion; }
    public function getResponsable(): Responsable { return $this->responsable; }
    public function getEstado(): string { return $this->estado; }

    // Método para obtener insignias de color en la interfaz según el estado
    public function getBadgeClass(): string {
        return match($this->estado) {
            'Almacenada' => 'bg-secondary',
            'En Proceso' => 'bg-warning text-dark',
            'Analizada' => 'bg-success',
            'Descartada' => 'bg-danger',
            default => 'bg-dark'
        };
    }
}
