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
            <a class="bg-black p-1 rounded-2" href="#" id="btnActualizarResultadosTable">
                <svg width="20" fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160 352 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l111.5 0c0 0 0 0 0 0l.4 0c17.7 0 32-14.3 32-32l0-112c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1L16 432c0 17.7 14.3 32 32 32s32-14.3 32-32l0-35.1 17.6 17.5c0 0 0 0 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.8c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352l34.4 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L48.4 288c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg>
            </a>
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
    <div class="d-flex justify-content-between m-2">
        <div>
            <p class="fs-6">Total de registros:  <span class="fw-bold" id="totalDocumentosEnviados"></span></p>
        </div>
        <div>
            <ul class="listadoOpcionesPaginacion" id="opcionesPaginacionDocumentosEnviados">
            </ul>
        </div>
    </div>
</div>

<?php require_once "seguimientoDocumento.php"?>
<?php require_once "detalleEnvio.php"?>

<script src="<?= base_url?>ajax/enviados.js"></script>
<script src="<?= base_url?>ajax/detalle.js"></script>