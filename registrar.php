<?php
require_once 'classes/TipoMuestra.php';
require_once 'classes/Responsable.php';
require_once 'classes/MuestraBiologica.php';
require_once 'classes/GestorMuestras.php';

GestorMuestras::inicializarSesion();

$errores = [];
$exito = false;

// Tipos de muestra predefinidos para el sistema
$tiposDisponibles = [
    1 => new TipoMuestra(1, 'Sangre Humana/Animal'),
    2 => new TipoMuestra(2, 'Tejido Vegetal'),
    3 => new TipoMuestra(3, 'Cultivo Microbiano'),
    4 => new TipoMuestra(4, 'ADN / ARN Extractor')
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y limpiar datos
    $codigo = trim($_POST['codigo'] ?? '');
    $tipoId = (int)($_POST['tipo_muestra'] ?? 0);
    $procedencia = trim($_POST['procedencia'] ?? '');
    $fecha = trim($_POST['fecha_recoleccion'] ?? '');
    $cedulaResp = trim($_POST['cedula_responsable'] ?? '');
    $nombreResp = trim($_POST['nombre_responsable'] ?? '');
    $labResp = trim($_POST['laboratorio'] ?? '');
    $estado = trim($_POST['estado'] ?? 'Almacenada');

    // Validaciones de datos
    if (empty($codigo)) {
        $errores[] = "El código de la muestra es obligatorio.";
    } elseif (GestorMuestras::buscarPorCodigo($codigo) !== null) {
        $errores[] = "Ya existe una muestra registrada con el código '$codigo'.";
    }

    if (!array_key_exists($tipoId, $tiposDisponibles)) {
        $errores[] = "Debe seleccionar un tipo de muestra válido.";
    }

    if (empty($procedencia)) {
        $errores[] = "La procedencia es obligatoria.";
    }

    if (empty($fecha)) {
        $errores[] = "La fecha de recolección es obligatoria.";
    }

    if (empty($cedulaResp) || empty($nombreResp)) {
        $errores[] = "La cédula y el nombre del responsable son obligatorios.";
    }

    // Si no hay errores, se crean los objetos y se guardan
    if (empty($errores)) {
        $tipoObj = $tiposDisponibles[$tipoId];
        $responsableObj = new Responsable($cedulaResp, $nombreResp, $labResp);
        $nuevaMuestra = new MuestraBiologica($codigo, $tipoObj, $procedencia, $fecha, $responsableObj, $estado);

        GestorMuestras::agregarMuestra($nuevaMuestra);
        $exito = true;
    }
}

include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="fw-bold mb-3"><i class="bi bi-file-earmark-plus"></i> Registrar Nueva Muestra Biológica</h3>
                <p class="text-muted">Complete los campos requeridos para registrar una nueva muestra en el sistema.</p>
                <hr>

                <!-- Manejo básico de errores y éxito -->
                <?php if (!empty($errores)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errores as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if ($exito): ?>
                    <div class="alert alert-success">
                        ¡Muestra registrada con éxito! Puedes verla en el <a href="index.php" class="alert-link">listado general</a>.
                    </div>
                <?php endif; ?>

                <form method="POST" action="registrar.php" class="needs-validation">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="codigo" class="form-label fw-semibold">Código de Muestra</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ej: BIO-105" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tipo_muestra" class="form-label fw-semibold">Tipo de Muestra</label>
                            <select class="form-select" id="tipo_muestra" name="tipo_muestra" required>
                                <option value="">Seleccione...</option>
                                <?php foreach ($tiposDisponibles as $id => $t): ?>
                                    <option value="<?= $id ?>"><?= htmlspecialchars($t->getNombre()) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="procedencia" class="form-label fw-semibold">Procedencia (Origen)</label>
                            <input type="text" class="form-control" id="procedencia" name="procedencia" placeholder="Ej: Invernadero B - Sector 3" required>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_recoleccion" class="form-label fw-semibold">Fecha de Recolección</label>
                            <input type="date" class="form-control" id="fecha_recoleccion" name="fecha_recoleccion" required>
                        </div>
                        
                        <h5 class="mt-4 text-secondary"><i class="bi bi-person-badge"></i> Datos del Responsable</h5>
                        
                        <div class="col-md-4">
                            <label for="cedula_responsable" class="form-label fw-semibold">Cédula</label>
                            <input type="text" class="form-control" id="cedula_responsable" name="cedula_responsable" placeholder="Ej: 10203040" required>
                        </div>
                        <div class="col-md-8">
                            <label for="nombre_responsable" class="form-label fw-semibold">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre_responsable" name="nombre_responsable" placeholder="Ej: Dr. Roberto Gómez" required>
                        </div>
                        <div class="col-md-6">
                            <label for="laboratorio" class="form-label fw-semibold">Laboratorio / Área</label>
                            <input type="text" class="form-control" id="laboratorio" name="laboratorio" placeholder="Ej: Lab Genética Molecular">
                        </div>
                        <div class="col-md-6">
                            <label for="estado" class="form-label fw-semibold">Estado Inicial</label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="Almacenada">Almacenada</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="Analizada">Analizada</option>
                                <option value="Descartada">Descartada</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success px-4"><i class="bi bi-save"></i> Guardar Muestra</button>
                            <a href="index.php" class="btn btn-secondary px-3">Volver al Listado</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
