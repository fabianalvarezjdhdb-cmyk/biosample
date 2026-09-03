<?php
require_once 'classes/TipoMuestra.php';
require_once 'classes/Responsable.php';
require_once 'classes/MuestraBiologica.php';
require_once 'classes/GestorMuestras.php';

GestorMuestras::inicializarSesion();

// Capturar parámetros de búsqueda y filtro por GET
$busqueda = $_GET['busqueda'] ?? '';
$filtroEstado = $_GET['estado'] ?? '';

$muestrasFiltradas = GestorMuestras::filtrar($busqueda, $filtroEstado);

include 'includes/header.php';
?>

<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="fw-bold text-dark"><i class="bi bi-box-seam"></i> Inventario de Muestras Biológicas</h2>
        <p class="text-muted">Gestión, control de estados y trazabilidad de muestras de laboratorio.</p>
    </div>
</div>

<!-- Formulario de Búsqueda y Filtros -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form method="GET" action="index.php" class="row g-3">
            <div class="col-md-5">
                <label for="busqueda" class="form-label fw-semibold">Buscar (Código, Procedencia, Responsable)</label>
                <input type="text" class="form-control" id="busqueda" name="busqueda" value="<?= htmlspecialchars($busqueda) ?>" placeholder="Ej: BIO-001">
            </div>
            <div class="col-md-4">
                <label for="estado" class="form-label fw-semibold">Filtrar por Estado</label>
                <select class="form-select" id="estado" name="estado">
                    <option value="">Todos los estados</option>
                    <option value="Almacenada" <?= $filtroEstado === 'Almacenada' ? 'selected' : '' ?>>Almacenada</option>
                    <option value="En Proceso" <?= $filtroEstado === 'En Proceso' ? 'selected' : '' ?>>En Proceso</option>
                    <option value="Analizada" <?= $filtroEstado === 'Analizada' ? 'selected' : '' ?>>Analizada</option>
                    <option value="Descartada" <?= $filtroEstado === 'Descartada' ? 'selected' : '' ?>>Descartada</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100 me-2"><i class="bi bi-search"></i> Filtrar</button>
                <a href="index.php" class="btn btn-outline-secondary w-100">Limpiar</a>
            </div>
        </form>
    </div>
</div>

<!-- Tabla de Resultados -->
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Procedencia</th>
                        <th>Fecha</th>
                        <th>Responsable</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($muestrasFiltradas)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-exclamation-circle fs-3 d-block mb-2"></i>
                                No se encontraron muestras registradas con los criterios especificados.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($muestrasFiltradas as $muestra): ?>
                            <tr>
                                <td class="fw-bold"><?= htmlspecialchars($muestra->getCodigo()) ?></td>
                                <td><?= htmlspecialchars($muestra->getTipoMuestra()->getNombre()) ?></td>
                                <td><?= htmlspecialchars($muestra->getProcedencia()) ?></td>
                                <td><?= htmlspecialchars($muestra->getFechaRecoleccion()) ?></td>
                                <td><?= htmlspecialchars($muestra->getResponsable()->getNombreCompleto()) ?></td>
                                <td>
                                    <span class="badge <?= $muestra->getBadgeClass() ?>">
                                        <?= htmlspecialchars($muestra->getEstado()) ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="detalle.php?codigo=<?= urlencode($muestra->getCodigo()) ?>" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i> Detalle
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
