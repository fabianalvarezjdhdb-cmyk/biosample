<?php
require_once 'classes/TipoMuestra.php';
require_once 'classes/Responsable.php';
require_once 'classes/MuestraBiologica.php';
require_once 'classes/GestorMuestras.php';

GestorMuestras::inicializarSesion();

$codigo = $_GET['codigo'] ?? '';
$muestra = GestorMuestras::buscarPorCodigo($codigo);

include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <?php if ($muestra === null): ?>
            <div class="alert alert-warning text-center py-5">
                <i class="bi bi-exclamation-triangle fs-1 d-block mb-3">}</i>
                <h4>Registro no encontrado</h4>
                <p class="text-muted">La muestra con el código especificado no existe o fue eliminada de la sesión.</p>
                <a href="index.php" class="btn btn-primary mt-3">Volver al Listado</a>
            </div>
        <?php else: ?>
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold mb-0"><i class="bi bi-info-circle"></i> Detalle de Muestra</h3>
                        <span class="badge fs-6 <?= $muestra->getBadgeClass() ?>">
                            <?= htmlspecialchars($muestra->getEstado()) ?>
                        </span>
                    </div>
                    
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="fw-semibold text-secondary">Código Único:</span>
                            <span class="fw-bold text-dark"><?= htmlspecialchars($muestra->getCodigo()) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="fw-semibold text-secondary">Tipo de Muestra:</span>
                            <span><?= htmlspecialchars($muestra->getTipoMuestra()->getNombre()) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="fw-semibold text-secondary">Procedencia:</span>
                            <span><?= htmlspecialchars($muestra->getProcedencia()) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="fw-semibold text-secondary">Fecha de Recolección:</span>
                            <span><?= htmlspecialchars($muestra->getFechaRecoleccion()) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="fw-semibold text-secondary">Responsable:</span>
                            <span><?= htmlspecialchars($muestra->getResponsable()->getNombreCompleto()) ?> (Cédula: <?= htmlspecialchars($muestra->getResponsable()->getCedula()) ?>)</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="fw-semibold text-secondary">Laboratorio:</span>
                            <span><?= htmlspecialchars($muestra->getResponsable()->getLaboratorio()) ?></span>
                        </li>
                    </ul>

                    <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver al Listado</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
