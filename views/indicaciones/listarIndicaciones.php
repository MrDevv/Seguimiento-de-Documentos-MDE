<?php
require_once('../../config/parameters.php');
require_once('../../config/DataBase.php');
?>

<div class="containerListadoArea">
    <div class="listadoAreas_header">
        <div>
            <h2>Bandeja de Entrada</h2>
            <p>Listado de Indicaciones</p>
        </div>
        <a href="" id="btnRegistrarIndicacion" class="btnNuevoRegistro">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
            Nueva Indicación
        </a>
    </div>
    <div class="listadoAreas_body">
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="bodyListaIndicaciones">
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between m-2">
        <div>
            <p class="fs-6">Total de registros:  <span class="fw-bold" id="totalIndicacionesRegistradas"></span></p>
        </div>
        <div>
            <ul class="listadoOpcionesPaginacion" id="opcionesPaginacionIndicaciones">
            </ul>
        </div>
    </div>
</div>

<?php  require_once "editarIndicacion.php"?>
<?php  require_once "registroIndicacion.php"?>

<script src="<?= base_url?>ajax/indicacionesCrud.js"></script>