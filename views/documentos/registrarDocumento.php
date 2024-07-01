<div class="containerRegistroDocumento">
    <h2>Registrar Documento</h2>
    <div class="body">
        <form action="<?=base_url?>documento/registrar" method="post">
            <div class="row">
                <div>
                    <label>Nro. Documento</label>
                    <input
                            type="text"
                            name="nroDocumento"
                            required
                    >
                </div>
                <div>
                    <label>Asunto</label>
                    <input
                            type="text"
                            name="asunto"
                            required
                    >
                </div>
            </div>
            <div class="row">
                <div>
                    <label>Folios</label>
                    <input
                            type="text"
                            name="folios"
                            required
                    >
                </div>
                <div>
                    <label>Tipo de Documento</label>
                    <select class="containerRegistroArea" id="tipoDocumento" name="tipoDocumento">
                        <?php foreach ($tiposDocumentos as $result):?>
                            <option
                                    value="<?=$result['codTipoDocumento']?>"
                            >
                                <?=$result['descripcion']?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div>
                    <label>Fecha registro</label>
                    <input
                            type="date"
                            value="<?php echo $fechaActual; ?>"
                            name="fechaRegistro"
                            disabled
                            required>
                </div>
            </div>

            <input type="submit" value="Registrar">
        </form>
    </div>
</div>