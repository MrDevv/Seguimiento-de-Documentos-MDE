<?php
    session_start();
    require_once "../../config/parameters.php"
?>


<div class="containerPendientesRecepcion">
    <div class="pendientesRecepcion_header">
        <h2>Bandeja de Entrada</h2>
        <p>Lista de documentos pendientes de recepcion</p>
        <div class="containerFiltrado">
            <div class="d-flex gap-2">
                <?php if ($_SESSION['user']['rol'] == 'administrador área'): ?>
                    <div>
                        <label>Documentos:</label>
                        <select class="selectFiltroArea selectRolPendientesRecepcion">
                            <option value="0">Para mi</option>
                            <option value="1">Todos</option>
                        </select>
                    </div>
                <a href="#" class="btnFiltrarReportes" id="filtrarPorRolPendientesRecepcion">Filtrar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="pendientesRecepcion_body">
        <table>
            <thead>
                <tr>
                    <th>Código Recepcion</th>
                    <th>N° Documento</th>
                    <th>Folios</th>
                    <th>Tipo Documento</th>
                    <th>Area Origen</th>
                    <th>Usuario Origen</th>
                    <th>Fecha Envio</th>
                    <th>Hora Envio</th>
                    <th>Observacion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="bodyPendientesRecepcion">
            </tbody>
        </table>
    </div>
</div>

<?php require_once "seguimientoDocumento.php"?>
<?php require_once "detalleEnvio.php"?>

<script src="<?= base_url?>ajax/recepcion.js"></script>
<script src="<?= base_url?>ajax/detalle.js"></script>