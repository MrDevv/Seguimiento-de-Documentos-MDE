<?php
require_once('models/Estado.php');
$estado = new Estado();
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
                value="<?=$response [0]['descripcion']?>">

                <input
                    style="display: none"
                    type="number"
                    name="codArea"
                    value="<?= $response[0]['codArea']?>"
                    required
            >

             </div>

             <div class="body">
                <label for="estado">Estado:</label>
                    <select class="containerRegistroArea" id="estado" name="estado">
                        <?php foreach ($estados as $result):?>
                        <option 
                        value="<?=$result['codEstado']?>"
                        <?=$result['codEstado']==$response[0]['codEstado']?"selected":''?>
                        >
                        <?=$result['descripcion']?>
                    </option>
                        
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="submit" value="Actualizar">
        </div>

    </form>

</div>
