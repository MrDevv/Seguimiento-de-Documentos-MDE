<div id="modalEditarPerfil" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar mi Perfil</h5>
            </div>
            <form class="formArea" id="editarPerfilForm" action="" method="post">
                <div class="modal-body">
                    <h6 class="fw-bold">Datos Generales</h6>

                        <input class="nombre invisible" type="text" id="codPersonaEditarPerfil" autocomplete="off" maxlength="30">

                        <input class="apellido invisible" type="text"  id="codUsuarioEditarPerfil" autocomplete="off" maxlength="30">

                    <div class="row mb-3">
                        <input type="hidden" id="codPersona">
                        <div class="col-sm-6">
                            <label for="nombresNuevo" class="form-label">Nombres (*):</label>
                            <input class="nombre" type="text" id="nombresEditarPerfil" autocomplete="off" maxlength="30">
                        </div>
                        <div class="col-sm-6">
                            <label for="apellidosNuevo" class="form-label">Apellidos (*):</label>
                            <input class="apellido" type="text"  id="apellidosEditarPerfil" autocomplete="off" maxlength="30">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="telefonoNuevo" class="form-label">Teléfono (*):</label>
                            <input type="number" id="telefonoEditarPerfil" name="telefono" autocomplete="off">
                        </div>
                        <div class="col-sm-6">
                            <label for="dniNuevo" class="form-label">DNI (*):</label>
                            <input type="number" id="dniEditarPerfil" name="dni" autocomplete="off">
                        </div>
                    </div>

                    <h6 class="fw-bold">Datos Usuario</h6>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="usuarioNuevo" class="form-label">Usuario:</label>
                            <input class="disabled usuario" type="text" id="usuarioEditarPerfil" name="usuario" autocomplete="off" readonly maxlength="20">
                        </div>
                        <div class="col-sm-6">
                            <label for="usuarioNuevo" class="form-label">Contraseña:</label>
                            <input class="usuario" type="password" id="passwordEditarPerfil" name="usuario" autocomplete="off" maxlength="20">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="usuarioNuevo" class="form-label">Rol:</label>
                            <input class="disabled usuario" type="text" id="rolEditarPerfil" name="usuario" autocomplete="off" readonly maxlength="20">
                        </div>
                        <div class="col-sm-6">
                            <label for="usuarioNuevo" class="form-label">Confirmar contraseña:</label>
                            <input class="usuario" type="password" id="confirmarPasswordEditarPerfil" name="usuario" autocomplete="off" maxlength="20">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="usuarioNuevo" class="form-label">Área:</label>
                            <input class="disabled usuario" type="text" id="areaEditarPerfil" name="usuario" autocomplete="off" readonly maxlength="20">
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