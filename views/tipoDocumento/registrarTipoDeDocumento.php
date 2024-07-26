<div id="modalRegistrarTipoDocumento" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Tipo Documento</h5>
            </div>
            <form class="formArea" id="registrarTipoDocumentoForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcionTipoDocumento" class="form-label">Descripción (*):</label>
                        <input
                                type="text"
                                id="descripcionTipoDocumentoNuevo"
                                autocomplete="off"
                                placeholder="ejemplo: Informe"
                                maxlength="20">
                    </div>
                    <p>Todos los campos (*) son obligatorios</p>
                </div>
                <div class="containerButtonsEditarArea">
                    <input type="submit" class="btn" value="Registrar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>