<div class="containerRegistroDocumento">
    <h2>Enviar Documento</h2>
    <div class="body">
        <form action="<?=base_url?>envio/enviar" method="post">
            <h2>Seleccione el usuario que recibirá este documento</h2>
            <div class="row">
                <div>
                    <label>Usuario Destino</label>
                    <select class="containerRegistroArea" name="usuarioAreaDestino">
                        <?php foreach ($response['data'] as $result):?>
                            <option
                                    value="<?=$result['codUsuarioArea']?>"
                            >
                                <?=$result['usuario']?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div>
                <input
                        class="disabled invisible"
                        type="text"
                        name="codRecepcion"
                        value="<?php echo trim($codRecepcion) ?>"
                        readonly
                        required
                >
                <input
                        class="disabled invisible"
                        type="text"
                        name="nroDocumento"
                        value="<?php echo $numDocumento ?>"
                        readonly
                        required
                >
                <input
                        class="disabled invisible"
                        type="text"
                        name="folios"
                        value="<?php echo $folios ?>"
                        required
                >
                <input
                        class="disabled invisible"
                        type="text"
                        name="movimiento"
                        value="<?php echo $movimiento ?>"
                        required
                >
                <input
                        class="disabled invisible"
                        type="text"
                        name="folios"
                        value="<?php echo $area ?>"
                        required
                >
                <input
                        class="disabled invisible"
                        type="text"
                        name="observacion"
                        value="<?php echo $observacion ?>"
                >
            </div>

            <input type="submit" value="Enviarrrr">
        </form>
    </div>
</div>