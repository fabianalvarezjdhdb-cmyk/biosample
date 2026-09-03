<?php
class GestorMuestras {
   
    public static function inicializarSesion(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['muestras'])) {
            $_SESSION['muestras'] = [];
        }
    }

    public static function obtenerMuestras(): array {
        self::inicializarSesion();
        return $_SESSION['muestras'];
    }

    public static function agregarMuestra(MuestraBiologica $muestra): void {
        self::inicializarSesion();
        $_SESSION['muestras'][$muestra->getCodigo()] = $muestra; // Arreglo asociativo usando el código como clave
    }

    public static function buscarPorCodigo(string $codigo): ?MuestraBiologica {
        $muestras = self::obtenerMuestras();
        return $muestras[$codigo] ?? null;
    }

    public static function filtrar(?string $busqueda, ?string $estado): array {
        $muestras = self::obtenerMuestras();
       
        return array_filter($muestras, function(MuestraBiologica $m) use ($busqueda, $estado) {
            $coincideBusqueda = true;
            $coincideEstado = true;

            if (!empty($busqueda)) {
                $q = strtolower($busqueda);
                $coincideBusqueda = str_contains(strtolower($m->getCodigo()), $q) ||
                                    str_contains(strtolower($m->getProcedencia()), $q) ||
                                    str_contains(strtolower($m->getResponsable()->getNombreCompleto()), $q);
            }

            if (!empty($estado)) {
                $coincideEstado = ($m->getEstado() === $estado);
            }

            return $coincideBusqueda && $coincideEstado;
        });
    }
}
