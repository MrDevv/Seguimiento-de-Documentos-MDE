<div id="modalCulminarSeguimientroDocumento" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Culminar Seguimiento de un Documento</h5>
            </div>
            <form class="formArea" id="culminarSeguimientoDocumentoForm" action="" method="post">
                <div class="modal-body">
                    <div class="containerCamposEnvio">
                        <div class="campoNroDocumento">
                            <label for="nroDocumentoEnvio" class="form-label col-sm-4">Nro. Documento (*):</label>
                            <input
                                type="text"
                                id="nroDocumentoCulminarSeguimiento"
                                autocomplete="off"
                                maxlength="20"
                            >
                        </div>
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsEditarArea">
                    <input type="submit" class="btn btn-primary" value="Dar por culminado">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

