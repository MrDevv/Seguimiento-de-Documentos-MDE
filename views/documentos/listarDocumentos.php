<?php
require_once('../../config/parameters.php');
session_start();
?>

<div class="containerPendientesRecepcion">
    <div class="pendientesRecepcion_header">
        <div class="d-flex justify-content-between">
            <h2>GESTION DE DOCUMENTOS</h2>
            <a href="#" class="btnNuevoRegistro" id="btnNuevoRegistro">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                Nuevo Documento
            </a>
        </div>
        <div class="description_btnNuevoDocumento">
            <div>
                <p>Listado de Documentos</p>
                <div class="containerFiltrado">
                    <div class="busqueda">
                        <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.25 22.5002L18.8213 17.4334M18.8213 17.4334C19.7499 16.5667 20.4865 15.5378 20.989 14.4054C21.4916 13.273 21.7503 12.0593 21.7503 10.8336C21.7503 9.60787 21.4916 8.39417 20.989 7.26177C20.4865 6.12937 19.7499 5.10044 18.8213 4.23374C17.8927 3.36704 16.7902 2.67953 15.5769 2.21048C14.3637 1.74142 13.0633 1.5 11.75 1.5C10.4368 1.5 9.13637 1.74142 7.92308 2.21048C6.70979 2.67953 5.60737 3.36704 4.67876 4.23374C2.80335 5.98413 1.74976 8.35816 1.74976 10.8336C1.74976 13.309 2.80335 15.683 4.67876 17.4334C6.55418 19.1838 9.09778 20.1671 11.75 20.1671C14.4022 20.1671 16.9459 19.1838 18.8213 17.4334Z" stroke="#0C7260" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
                        </svg>
                        <input
                                id="numDocumentoListadoDocumentos"
                                type="text"
                                name="numDoc"
                                value=""
                                autocomplete="off"
                                placeholder="Número de Documento">
                    </div>
                </div>
            </div>
            <?php if ($_SESSION['user']['rol'] != 'usuario'): ?>
            <div class="d-flex gap-5">
                <a href="#" class="btnCulminarSeguimiento" id="btnCulminarSeguimiento">
                    Culminar Seguimiento
                </a>
                <a class="bg-black p-1 rounded-2" href="#" id="btnActualizarResultadosTable">
                    <svg width="20" fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160 352 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l111.5 0c0 0 0 0 0 0l.4 0c17.7 0 32-14.3 32-32l0-112c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1L16 432c0 17.7 14.3 32 32 32s32-14.3 32-32l0-35.1 17.6 17.5c0 0 0 0 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.8c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352l34.4 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L48.4 288c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-1">
    </div>
    <div class="listadoDocumentos_body">
        <table>
            <thead>
            <tr>
                <th>Nro Documento</th>
                <th>Tipo Documento</th>
                <th>Asunto</th>
                <th>Folios</th>
                <th>Fecha Registro</th>
                <th>Usuario Registrador</th>
                <th>Area</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="bodyListaDocumentos">
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between m-2">
        <div>
            <p class="fs-6">Total de registros:  <span class="fw-bold" id="totalDocumentosRegistrados"></span></p>
        </div>
        <div>
            <ul class="listadoOpcionesPaginacion" id="opcionesPaginacionDocumentos">
            </ul>
        </div>
    </div>
</div>

<?php require_once "registrarEnvio.php"?>
<?php require_once "registrarDocumento.php"?>
<?php require_once "editarDocumento.php"?>
<?php require_once "seguimientoDocumento.php"?>
<?php require_once "detalleEnvio.php"?>
<?php require_once "culminarSeguimiento.php"?>

<script src="<?= base_url?>ajax/tipoDocumento.js"></script>
<script src="<?= base_url?>ajax/documentos.js"></script>
<script src="<?= base_url?>ajax/detalle.js"></script>