<div id="modalCambiarAreaUsuario" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar de Area a un Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="formArea" id="cambiarAreaUsuarioForm" action="" method="post">
                <div class="modal-body">
                    <input
                            type="hidden"
                            id="codUsuarioArea">
                    <input
                            type="hidden"
                            id="codUsuario">

                    <div class="mb-3">
                        <label for="selectRol" class="form-label">Nombre del Usuario:</label>
                        <input type="text" class="disabled" id="nombreUsuarioDetalle">
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="selectRol" class="form-label">Área actual:</label>
                        <input type="text" class="disabled" id="areaActualDetalle">
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="selectRol" class="form-label">Área Nueva (*):</label>
                        <select class="form-select selectArea"  id="selectAreaCambiar" name="areaCambiar" required>
                        </select>
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsEditarArea">
                    <input type="submit" class="btn" value="Cambiar Área">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>