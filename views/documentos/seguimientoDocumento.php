<div id="modalSeguimientoDocumento" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver Seguimiento de un Documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="seguimiento_body">
                    <div class="infoGeneral">
                        <div class="containerInfoDoc">
                            <p>N° Documento: <span id="numDocumentoSeguimiento"> </span></p>
                            <p>Tipo Documento: <span id="tipoDocumentoSeguimiento"></span></p>
                        </div>
                        <div
                                class="containerEstadoDoc"
                        >
                            <p>Estado Documento:
                                <span id="estadoDocumentoSeguimiento" class=""></span>
                        </span>
                            </p>
                        </div>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <th>N° Movimiento</th>
                            <th>Folios</th>
                            <th>Area Origen</th>
                            <th>Usuario Origen</th>
                            <th>Fecha Envio</th>
                            <th class="columArrow"></th>
                            <th>Area Destino</th>
                            <th>Usuario Destino</th>
                            <th>Fecha Recepción</th>
                            <th>Observacion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody id="bodySeguimiento">
                        </tbody>
                    </table>
            </div>

        </div>
    </div>
</div>


