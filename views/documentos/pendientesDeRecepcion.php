<?php
    require_once "../../config/parameters.php"
?>


<div class="containerPendientesRecepcion">
    <div class="pendientesRecepcion_header">
        <h2>Bandeja de Entrada</h2>
        <p>Lista de documentos pendientes de recepcion</p>
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

<script src="<?= base_url?>ajax/pendientesRecepcion.js"></script>