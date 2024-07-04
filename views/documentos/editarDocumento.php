<div class="containerRegistroDocumento">
    <h2>Editar Documento</h2>
    <div class="body">
        <form action="<?=base_url?>documento/actualizar" method="post">
            <div class="row">
                <div>
                    <label>Nro. Documento</label>
                    <input
                        class="disabled"
                        type="text"
                        name="nroDocumento"
                        value="<?=$documentoDB->getNumDocumento()?>"
                        readonly
                        required
                    >
                </div>
                <div>
                    <label>Asunto</label>
                    <input
                        type="text"
                        name="asunto"
                        value="<?=$documentoDB->getAsunto()?>"
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
                        value="<?=$documentoDB->getFolios()?>"
                        required
                    >
                </div>
                <div>
                    <label>Tipo de Documento</label>
                    <select class="containerRegistroArea" name="tipoDocumento">
                        <?php foreach ($tiposDocumentos as $result):?>
                            <option
                                value="<?=$result['codTipoDocumento']?>"
                                <?=trim($result['descripcion']) == $documentoDB->getTipoDocumento() ? 'selected' : ''?>
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
                        class="disabled"
                        type="date"
                        value="<?=$documentoDB->getFechaRegistro()?>"
                        name="fechaRegistro"
                        disabled
                        required>
                </div>
            </div>

            <input type="submit" value="Actualizar">
        </form>
    </div>
</div>