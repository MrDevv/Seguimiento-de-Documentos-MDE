<div id="modalRegistrarEnvio" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered <?=($_SESSION['user']['rol'] == 'administrador') ? 'modal-envioDocumento' : 'modal-lg'?>" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <svg class="me-2" width="20" height="20" viewBox="0 0 36 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M30.982 4.51905L5.79801 13.2456L14.188 17.8993L21.586 10.8076C21.9613 10.4482 22.4702 10.2464 23.0007 10.2466C23.5313 10.2468 24.04 10.449 24.415 10.8086C24.79 11.1682 25.0006 11.6559 25.0004 12.1644C25.0002 12.6728 24.7893 13.1603 24.414 13.5197L17.014 20.6114L21.874 28.6499L30.982 4.51905ZM31.628 0.218055C34.018 -0.611862 36.334 1.60764 35.468 3.89805L24.904 31.891C24.036 34.1871 20.764 34.467 19.486 32.3529L13.052 21.7001L1.93601 15.5341C-0.269988 14.3094 0.0220122 11.1737 2.41801 10.3419L31.628 0.218055Z" fill="white"/>
                </svg>
                <h5 class="modal-title" id="exampleModalLabel">Enviar Documento</h5>
            </div>
            <form class="formArea" id="registrarEnvioForm" action="" method="post">
                <div class="modal-body">
                    <input
                            class="disabled invisible form-control mb-3"
                            type="text"
                            id="codRecepcion"
                            readonly
                            required
                            placeholder="Código de Recepción"
                    >

                    <div class="containerCamposEnvio">
                        <div class="campoNroDocumento">
                            <label for="nroDocumentoEnvio" class="form-label col-sm-4">Nro. Documento (*):</label>
                            <input
                                    type="text"
                                    class="disabled"
                                    id="nroDocumentoEnvio"
                                    autocomplete="off"
                                    maxlength="20"
                                    readonly
                            >
                        </div>
                        <div class="campoFolios">
                            <label for="foliosEnvio" class="form-label col-sm-4">Folios (*):</label>
                            <input
                                    type="text"
                                    id="foliosEnvio"
                                    autocomplete="off"
                                    maxlength="20"
                            >
                        </div>
                        <div class="campoMovimiento">
                            <label for="movimientoEnvio" class="form-label col-sm-4">Indicación (*):</label>
                            <select class="selectMovimiento" id="movimientoEnvio">
                            </select>
                            <?php if($_SESSION['user']['rol'] == 'administrador'): ?>
                                <a href="#" class="btnNuevaAreaEnvio p-2 bg-success text-white text-center rounded-1" id="btnRegistrarIndicacion">Registrar nueva Indicación</a>
                            <?php endif; ?>
                        </div>
                        <div class="campoArea">
                            <label for="areaEnvio" class="form-label col-sm-4">Área (*):</label>
                            <select class="selectArea" id="areaEnvio">
                            </select>
                            <?php if($_SESSION['user']['rol'] == 'administrador'): ?>
                                <a href="#" class="btnNuevaAreaEnvio p-2 bg-success text-white text-center rounded-1" id="btnRegistrarArea">Registrar nueva Área</a>
                            <?php endif; ?>
                        </div>
                        <div class="campoUsuario d-flex">
                            <label for="usuarioEnvio" class="form-label col-sm-4">Para (*):</label>
                            <select class="selectUsuarioDestino" id="usuarioDestino">
                                <option value="0">Seleccionar</option>
                            </select>
                            <?php if($_SESSION['user']['rol'] == 'administrador'): ?>
                            <a href="#" class="btnNuevaAreaEnvio p-2 bg-success text-white text-center rounded-1" id="btnRegistrarUsuario">Registrar nuevo Usuario</a>
                            <?php endif; ?>
                        </div>
                        <div class="campoObservacion">
                            <label for="observacionEnvio" class="form-label col-sm-4">Observación:</label>
                            <textarea id="observacionEnvio" class="form-control"></textarea>
                        </div>
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsEditarArea">
                    <input type="submit" class="btn btn-primary" value="Enviar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once "../usuario/registro.php" ?>
<?php require_once "../area/registroArea.php" ?>
<?php require_once "../indicaciones/registroIndicacion.php" ?>

<script src="<?= base_url?>ajax/listarAreas.js"></script>
<script src="<?= base_url?>ajax/indicaciones.js"></script>
<script src="<?= base_url?>ajax/registrarAreaUsuarioEnvio.js"></script>
<script src="<?= base_url?>ajax/listarRoles.js"></script>