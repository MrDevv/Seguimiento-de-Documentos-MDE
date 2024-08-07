<?php
require_once('../../config/parameters.php');
session_start();
?>

<div class="containerEnviados">
    <div class="enviados_header">
        <h2>Bandeja de Entrada</h2>
        <p>Lista de documentos enviados</p>
        <div class="containerFiltrado">
            <div class="d-flex gap-2">
                <?php if ($_SESSION['user']['rol'] == 'administrador área'): ?>
                    <div>
                        <select class="selectFiltroArea selectRolEnviados">
                            <option value="0">Mis documentos enviados</option>
                            <option value="1">Documentos enviados por mi área</option>
                        </select>
                    </div>
                    <a href="#" class="btnFiltrarReportes" id="filtrarPorRolEnviados">Filtrar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="enviados_body">
        <table>
            <thead>
            <tr>
                <th>Código Envio</th>
                <th>N° Documento</th>
                <th>Folios</th>
                <th>Tipo Documento</th>
                <th>Area Destino</th>
                <th>Usuario Destino</th>
                <th>Fecha Envio</th>
                <th>Hora Envio</th>
                <th>Observacion</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="bodyListaDocumentosEnviados">
            </tbody>
        </table>
    </div>
</div>

<?php require_once "seguimientoDocumento.php"?>
<?php require_once "detalleEnvio.php"?>

<script src="<?= base_url?>ajax/enviados.js"></script>
<script src="<?= base_url?>ajax/detalle.js"></script>