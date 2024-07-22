<div id="modalEditarUsuario" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="formArea" id="editarUsuarioForm" action="" method="post">
                <div class="modal-body">
                    <h6 class="fw-bold">Datos Generales</h6>
                    <div class="row mb-3">
                        <input type="hidden" id="codPersona">
                        <div class="col-sm-6">
                            <label for="nombresNuevo" class="form-label">Nombres (*):</label>
                            <input class="nombre" type="text" id="nombresEditar" name="nombres" autocomplete="off" maxlength="30">
                        </div>
                        <div class="col-sm-6">
                            <label for="apellidosNuevo" class="form-label">Apellidos (*):</label>
                            <input class="apellido" type="text"  id="apellidosEditar" name="apellidos" autocomplete="off" maxlength="30">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="telefonoNuevo" class="form-label">Teléfono (*):</label>
                            <input type="number" id="telefonoEditar" name="telefono" autocomplete="off">
                        </div>
                        <div class="col-sm-6">
                            <label for="dniNuevo" class="form-label">DNI (*):</label>
                            <input type="number" id="dniEditar" name="dni" autocomplete="off">
                        </div>
                    </div>

                    <h6 class="fw-bold">Datos Usuario</h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="usuarioNuevo" class="form-label">Usuario: <small class="fw-bold">(Este campo se genera automaticamente)</small></label>
                            <input class="disabled usuario" type="text" id="usuarioEditar" name="usuario" autocomplete="off" readonly maxlength="20">
                        </div>
                        <div class="col-sm-6">
                            <label for="selectRol" class="form-label">Rol (*):</label>
                            <select class="form-select selectRol"  id="selectRolEditar" name="rol" required>
                            </select>
                        </div>
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsEditarArea">
                    <input type="submit" class="btn" value="Actualizar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url?>ajax/listarRoles.js"></script>
