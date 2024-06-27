<div class="containerRegistroTipoDocumento">
    <h2>Registro Tipo de Documento</h2>
        <form action="<?=base_url?>tipoDocumento/registrar" method="post">
            <div class="body">
                <label>Tipo de documento:</label>
                <input type="text" name="tipoDocumento" id="tipoDocumento" autocomplete="off" placeholder="ejemplo: informe" required>
            </div>
            <input type="submit" value="Registrar">
        </form>

</div>