<div id="modalRegistrarDocumento" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Documento</h5>
            </div>
            <form class="formArea" id="registrarDocumentoForm" action="" method="post">
                <div class="modal-body">
                    <div class="containerCamposEnvio">
                        <div class="campoNroDocumento">
                            <label for="nroDocumentoEnvio" class="form-label col-sm-4">Nro. Documento (*):</label>
                            <input
                                    type="text"
                                    id="nroDocumentoRegistro"
                                    autocomplete="off"
                                    maxlength="20"
                            >
                        </div>
                        <div class="campoArea">
                            <label for="tipoDocumento" class="form-label col-sm-4">Tipo Documento (*):</label>
                            <select class="selectTipoDocumento" id="tipoDocumentoRegistro">
                            </select>
                        </div>
                        <div class="campoFolios">
                            <label for="foliosEnvio" class="form-label col-sm-4">Folios (*):</label>
                            <input
                                    type="number"
                                    id="foliosRegistro"
                                    autocomplete="off"
                                    maxlength="20"
                            >
                        </div>
                        <div class="campoObservacion">
                            <label for="asunto" class="form-label col-sm-4">Asunto (*):</label>
                            <textarea id="asuntoRegistro" class="form-control"></textarea>
                        </div>
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsEditarArea">
                    <input type="submit" class="btn btn-primary" value="Registrar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

