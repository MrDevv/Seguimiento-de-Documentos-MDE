<?php
require_once('../../config/parameters.php');
require_once('../../config/DataBase.php');
?>
<div class="containerRegistroTipoDocumento">
    <form id="registrarAreaForm" action="<?=base_url?>area/registrar" method="post">
        <div>
        <h2>Registro Area</h2>
            <div class="body">
                <label for="nombre">Descripción:</label>
                <input type="text" id="descripcion" name="area" value="">
             </div>
                <input type="submit" value="Registrar">
        </div>

    </form>
</div>