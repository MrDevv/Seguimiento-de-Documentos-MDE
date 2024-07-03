<?php
require_once('models/Estado.php');
$estado = new EstadoController();
$estados= $estado->listarEstadosHabilitadoInhabilitado();

?>
<div class="containerRegistroTipoDocumento">
    <form id="registrarAreaForm" action="<?=base_url?>area/actualizar" method="post">
        <div>
        <h2>Actualizar Area</h2>
            <div class="body">
                <label for="nombre">Descripción:</label>
                <input 
                type="text"  
                name="area" 
                value="<?=$response[0]['descripcion']?>">

                <input
                    style="display: none"
                    type="number"
                    name="codArea"
                    value="<?= $response[0]['codArea']?>"
                    required
            >

             </div>

                <input type="submit" value="Actualizar">
        </div>

    </form>

</div>
