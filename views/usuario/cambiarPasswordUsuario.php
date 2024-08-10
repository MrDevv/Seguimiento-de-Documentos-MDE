<div id="modalCambiarPasswordUsuario" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña del Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="formArea" id="cambiarPasswordUsuarioForm" action="" method="post">
                <div class="modal-body">
                    <input
                        type="hidden"
                        id="codUsuarioPassword">

                    <div class="mb-3">
                        <label for="usuarioInfo" class="form-label">Usuario:</label>
                        <input type="text" class="disabled" id="usuarioDetallePassowrd" readonly>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nuevaPassword" class="form-label">Nueva contraseña:</label>
                        <input type="password" id="cambiarPassword">
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="confirmarPassword" class="form-label">Confirmar Contraseña:</label>
                        <input type="password" id="cambiarPasswordConfirmar">
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