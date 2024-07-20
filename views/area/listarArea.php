<?php
require_once('../../config/parameters.php');
require_once('../../config/DataBase.php');
require_once('../../models/Estado.php');
?>

<div class="containerListadoArea">
    <div class="listadoAreas_header">
        <h2>Bandeja de Entrada</h2>
        <p>Listado de Areas</p>
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
            <tbody id="bodyListaAreas">

            </tbody>
        </table>
    </div>

    <?php  require_once "editarArea.php"?>

    <script src="<?= base_url?>ajax/listarAreasTable.js"></script>

</div>