<?php
require_once('../../config/parameters.php');
?>

<div class="containerListadoTipoDocumentos">
    <div class="listadoTipoDocumentos_header">
        <div>
            <h2>Bandeja de Entrada</h2>
            <p>Listado de los Tipos de Documentos</p>
        </div>
        <a href="#" id="btnRegistrarTipoDocumento" class="btnNuevoRegistro">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
            Nuevo Tipo Documento
        </a>
    </div>
    <div class="listadoTipoDocumentos_body">
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Tipo Documento</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="bodyListaTipoDocumentos"></tbody>
        </table>
    </div>
</div>

<?php require_once "registrarTipoDeDocumento.php" ?>
<?php  require_once "editarTipoDocumento.php" ?>

<script src="<?= base_url?>ajax/tipoDocumento.js"></script>
