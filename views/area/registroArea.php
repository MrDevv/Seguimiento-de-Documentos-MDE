<?php
require_once('models/Estado.php');
$estado = new Estado();
$estados= $estado->listarEstadosHabilitadoInhabilitado();

?>
<div class="containerRegistroTipoDocumento">
    <form id="registrarAreaForm" action="<?=base_url?>area/registrar" method="post">
        <div>
        <h2>Registro Area</h2>
            <div class="body">
                <label for="nombre">Descripción:</label>
                <input type="text" id="descripcion" name="area" value="">
             </div>

             <div class="body">
                <label for="estado">Estado:</label>
                    <select class="containerRegistroArea" id="estado" name="estado">
                        <?php foreach ($estados as $result):?>
                        <option value="<?=$result['codEstado']?>"><?=$result['descripcion']?></option>
                        
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="submit" value="Registrar">
        </div>

    </form>

</div>