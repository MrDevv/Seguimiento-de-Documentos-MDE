<div id="modalEditarTipoDocumento" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Tipo Documento</h5>
            </div>
            <form class="formArea" id="editarTipoDocumentoForm" action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcionTipoDocumento" class="form-label">Descripción (*):</label>
                        <input
                                type="text"
                                id="descripcionTipoDocumento"
                                autocomplete="off"
                                placeholder="ejemplo: Informe"
                                maxlength="20">
                    </div>
                    <input type="hidden" id="codTipoDocumento">
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