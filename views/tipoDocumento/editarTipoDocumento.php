<div class="containerRegistroTipoDocumento">
    <h2>Editar Tipo de Documento</h2>
    <form id="registrarTipoDocumentoForm" action="<?=base_url?>tipoDocumento/registrar" method="post">
        <!--        <form id="registrarTipoDocumentoForm" action="--><?php //=base_url?><!--tipoDocumentoAJX/index" method="post">-->
        <!--            <input type="hidden" name="modulo_tipoDoc" value="registrar">-->
        <div class="body">
            <label>Tipo de documento:</label>
            <input type="text" name="tipoDocumento" id="tipoDocumento" autocomplete="off" placeholder="ejemplo: informe" required>
        </div>
        <input type="submit" value="Actualizar">
    </form>
</div>