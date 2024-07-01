<div class="containerRegistroTipoDocumento">
    <h2>Editar Area</h2>
    <form id="registrarAreaForm" action="<?=base_url?>area/registrar" method="post">
        <!--        <form id="registrarTipoDocumentoForm" action="--><?php //=base_url?><!--tipoDocumentoAJX/index" method="post">-->
        <!--            <input type="hidden" name="modulo_tipoDoc" value="registrar">-->
        <div class="body">
            <label>Descripcion:</label>
            <input type="text" name="area" id="area" autocomplete="off" placeholder="ejemplo: GAT" required>
        </div>
        <div class="body">
            <label>Estado:</label>
            <input type="text" name="estado" id="estado" autocomplete="off" placeholder="ejemplo: Habilitado" required>
        </div>
        <input type="submit" value="Actualizar">
    </form>
</div>