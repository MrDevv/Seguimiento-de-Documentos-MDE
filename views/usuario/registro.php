<div id="modalRegistrarUsuario" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Usuario</h5>
            </div>
            <form class="formArea" id="registrarUsuarioForm" action="" method="post">
                <div class="modal-body">
                    <h6 class="fw-bold">Datos Generales</h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="nombresNuevo" class="form-label">Nombres (*):</label>
                            <input class="nombre" type="text" id="nombresNuevo" name="nombres" autocomplete="off" maxlength="30">
                        </div>
                        <div class="col-sm-6">
                            <label for="apellidosNuevo" class="form-label">Apellidos (*):</label>
                            <input class="apellido" type="text"  id="apellidosNuevo" name="apellidos" autocomplete="off" maxlength="30">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="telefonoNuevo" class="form-label">Teléfono (*):</label>
                            <input type="number" id="telefonoNuevo" name="telefono" autocomplete="off">
                        </div>
                        <div class="col-sm-6">
                            <label for="dniNuevo" class="form-label">DNI (*):</label>
                            <input type="number" id="dniNuevo" name="dni" autocomplete="off">
                        </div>
                    </div>

                    <h6 class="fw-bold">Datos Usuario</h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="usuarioNuevo" class="form-label">Usuario: <small class="fw-bold">(Este campo se genera automaticamente)</small></label>
                            <input class="disabled usuario" type="text" id="usuarioNuevo" name="usuario" autocomplete="off" readonly maxlength="20">
                        </div>
                        <div class="col-sm-6">
                            <label for="passwordNuevo" class="form-label">Contraseña (*):</label>
                            <input type="password" id="passwordNuevo" name="password" autocomplete="off" maxlength="20">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="passwordConfirmarNuevo" class="form-label">Confirmar Contraseña (*):</label>
                            <input type="password" id="passwordConfirmarNuevo" name="passwordConfirmar" autocomplete="off" maxlength="20">
                        </div>
                        <div class="col-sm-6">
                            <label for="selectAreas" class="form-label">Área (*):</label>
                            <select class="form-select selectArea" id="selectAreas" name="area" required>
                            </select>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="selectRol" class="form-label">Rol (*):</label>
                            <select class="form-select selectRol" id="selectRol" name="rol" required>
                            </select>
                        </div>
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsEditarArea">
                    <input type="submit" class="btn" value="Registrar">
                    <button id="btnCancelarRegistroUsuario" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?=base_url?>helpers/generarUserName.js"></script>