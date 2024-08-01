<?php
require_once "../../config/parameters.php"
?>


<div class="containerRecepcionados">
    <div class="recepcionados_header">
        <h2>Bandeja de Entrada</h2>
        <p>Lista de documentos recepcionados</p>
    </div>
    <div class="recepcionados_body">
        <table>
            <thead>
            <tr>
                <th>Código Recepción</th>
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
            <tbody id="bodyRecepcionados">
            </tbody>
        </table>
    </div>

</div>

<?php require_once "seguimientoDocumento.php"?>
<?php require_once "registrarEnvio.php"?>
<?php require_once "detalleEnvio.php"?>

<script src="<?= base_url?>ajax/recepcionados.js"></script>
<script src="<?= base_url?>ajax/detalle.js"></script>