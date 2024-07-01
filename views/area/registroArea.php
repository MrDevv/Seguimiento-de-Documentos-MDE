<div class="containerRegistroTipoDocumento">
    <form id="registrarAreaForm" action="<?=base_url?>area/registrar" method="post">
        <div>
        <h2>Registro Area</h2>
            <div class="body">
                <label for="nombre">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" value="">
             </div>

             <div class="body">
                <label for="estado">Estado:</label>
                    <select class="containerRegistroArea" id="estado" name="estado">
                        <option value="habilitado">Seleccione</option>
                        <option value="habilitado">Habilitado</option>
                        <option value="habilitado">Deshabilitado</option>
                            <!-- Agrega más opciones según sea necesario -->
                    </select>
                </div>

                <input type="submit" value="Registrar">
        </div>

    </form>

</div>