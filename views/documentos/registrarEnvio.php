<div class="containerRegistroDocumento">
    <h2>Enviar Documento</h2>
    <div class="body">
        <form action="<?=base_url?>envio/usuarioDestino" method="post">
            <input
                    class="disabled invisible"
                    type="text"
                    name="codRecepcion"
                    value="<?php echo trim($codRecepcion) ?>"
                    readonly
                    required
            >
            <div class="row">
                <div>
                    <label>Nro. Documento</label>
                    <input
                            class="disabled"
                            type="text"
                            name="nroDocumento"
                            value="<?php echo trim($response['data'][0]['NumDocumento']) ?>"
                            readonly
                            required
                    >
                </div>
                <div>
                    <label>Folios</label>
                    <input
                            type="text"
                            name="folios"
                            required
                    >
                </div>
            </div>
            <div class="row">
                <div>
                    <label>Movimiento</label>
                    <select class="containerRegistroArea" name="movimiento">
                        <?php foreach ($movimientos as $result):?>
                            <option
                                    value="<?=$result['codMovimiento']?>"
                            >
                                <?=$result['descripcion']?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label>Area</label>
                    <select class="containerRegistroArea" name="area">
                        <?php foreach ($areas as $result):?>
                            <option
                                    value="<?=$result['codArea']?>"
                            >
                                <?=$result['descripcion']?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">

            </div>
            <div class="row">
                <div>
                    <label>Observacion</label>
                    <input
                            type="text"
                            name="observacion"
                    >
                </div>
                <div>
                    <label>Fecha de Envio</label>
                    <input
                            class="disabled"
                            type="date"
                            value="<?php echo $fechaActual; ?>"
                            name="fechaRegistro"
                            readonly
                            required>
                </div>
            </div>

            <input type="submit" value="Continuar">
        </form>
    </div>
</div>