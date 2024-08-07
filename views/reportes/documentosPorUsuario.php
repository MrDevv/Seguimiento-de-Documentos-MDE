<?php
session_start();
require_once('../../config/parameters.php');
?>
<div class="containerPendientesRecepcion">
    <div class="pendientesRecepcion_header">
        <h2>REPORTES</h2>
        <div class="description_btnNuevoDocumento">
            <p>Documentos por Usuario</p>
        </div>
        <div class="containerFiltrado">
            <div class="d-flex gap-2">
                <div>
                    <div class="busqueda">
                        <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.25 22.5002L18.8213 17.4334M18.8213 17.4334C19.7499 16.5667 20.4865 15.5378 20.989 14.4054C21.4916 13.273 21.7503 12.0593 21.7503 10.8336C21.7503 9.60787 21.4916 8.39417 20.989 7.26177C20.4865 6.12937 19.7499 5.10044 18.8213 4.23374C17.8927 3.36704 16.7902 2.67953 15.5769 2.21048C14.3637 1.74142 13.0633 1.5 11.75 1.5C10.4368 1.5 9.13637 1.74142 7.92308 2.21048C6.70979 2.67953 5.60737 3.36704 4.67876 4.23374C2.80335 5.98413 1.74976 8.35816 1.74976 10.8336C1.74976 13.309 2.80335 15.683 4.67876 17.4334C6.55418 19.1838 9.09778 20.1671 11.75 20.1671C14.4022 20.1671 16.9459 19.1838 18.8213 17.4334Z" stroke="#0C7260" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
                        </svg>
                        <input
                                id="numDocumentoReportePorUsuario"
                                type="text"
                                name="numDocumento"
                                autocomplete="off"
                                placeholder="Número de Documento">
                    </div>
                </div>
                <?php if ($_SESSION['user']['rol'] == 'administrador' || $_SESSION['user']['rol'] == 'administrador área'): ?>
                    <div>
                        <label>Usuario:</label>
                        <select class="selectFiltroArea selectUsuario" name="usuario">
                        </select>
                    </div>
                <a href="#" class="btnFiltrarReportes" id="filtrarPorUsuario">Filtrar</a>
                <?php endif; ?>
            </div>
            <div>
                <a href="#" id="btnReporteDocUsuarioPdf" class="w-100 rounded-2 p-2 bg-white d-flex justify-content-center align-items-center" >
                    <svg width="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#f10909" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/></svg>
                </a>
            </div>
        </div>


    </div>
    <div class="listadoDocumentos_body">
        <table>
            <thead>
            <tr>
                <th>Nro Documento</th>
                <th>Tipo Documento</th>
                <th>Asunto</th>
                <th>Folios Actuales</th>
                <th>Usuario</th>
                <th>Area</th>
                <th>Estado Documento</th>
                <th>Estado Envio</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="bodyListaDocumentosPorUsuario">
            </tbody>
        </table>
    </div>

</div>

<?php require_once "../documentos/seguimientoDocumento.php"?>
<?php require_once "../documentos/detalleEnvio.php"?>

<script src="<?= base_url?>ajax/documentoPorUsuarioReporte.js"></script>
<script src="<?= base_url?>ajax/llenarSelectUsuarios.js"></script>
<script src="<?= base_url?>ajax/detalle.js"></script>
<script src="<?= base_url?>ajax/reporteDocUsuariosPDF.js"></script>