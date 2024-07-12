<div class="containerRegistroTipoDocumento">
    <h2>Editar Tipo de Documento</h2>
    <form id="registrarTipoDocumentoForm" action="<?=base_url?>tipoDocumento/actualizar" method="post">
        <div class="body">
            <label>Tipo de documento:</label>
            <input
                    style="display: none"
                    type="number"
                    name="codTipoDocumento"
                    value="<?= $tipoDocumentoDB['data'][0]['codTipoDocumento']?>"
                    required
            >
            <input
                    type="text"
                    name="tipoDocumento"
                    id="tipoDocumento"
                    autocomplete="off"
                    placeholder="ejemplo: informe"
                    value="<?=trim($tipoDocumentoDB['data'][0]['descripcion'])?>"
                    maxlength="20"
                    required>
        </div>
        <input type="submit" value="Actualizar">
    </form>

<!--    --><?php //var_dump($tipoDocumentoDB[0]['descripcion']);?>
</div>