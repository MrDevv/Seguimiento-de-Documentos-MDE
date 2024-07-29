<div id="modalDetalleEnvio" class="modalArea modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle</h5>
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
                <div class="detalle">
                    <div class="datosOrigen">
                        <div class="datosOrigenHeader">
                            <h3>
                                Datos Origen
                            </h3>
                        </div>
                        <div class="datosOrigenBody">
                            <div>
                                <label>Area Origen</label>
                                <input
                                        type="text"
                                        name="areaOrigen"
                                        value="<?= $response['data'][0]['area origen']?>"
                                        readonly>
                            </div>
                            <div>
                                <label>Fecha Envio</label>
                                <input
                                        type="date"
                                        name="fechaEnvio"
                                        value="<?= $response['data'][0]['fechaEnvio']?>"
                                        readonly>
                            </div>
                            <div>
                                <label>Hora Envio</label>
                                <input
                                        type="text"
                                        name="horaEnvio"
                                        value="<?= $response['data'][0]['hora envio']?>"
                                        readonly>
                            </div>
                            <div>
                                <label>Usuario Origen</label>
                                <input
                                        type="text"
                                        name="usuarioOrigen"
                                        value="<?= $response['data'][0]['usuario origen']?>"
                                        readonly>
                            </div>
                            <div>
                                <label>Estado Envio</label>
                                <div class="estadosDetalle">
                                    <span class="estado recepcionado"> Recepcionado </span>
                                    <span class="estado enviado"> Enviado </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containerArrowDetalle">
                        <svg class="arrowDetalle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
                    </div>
                    <div class="datosDestino">
                        <div class="datosDestinoHeader">
                            <h3>
                                Datos Destino
                            </h3>
                        </div>
                        <div class="datosDestinoBody">
                            <div>
                                <label>Area Destino</label>
                                <input
                                        type="text"
                                        name="areaDestino"
                                        value="<?= $response['data'][0]['area destino']?>"
                                        readonly
                                >
                            </div>
                            <div>
                                <label>Fecha Recepción</label>
                                <input
                                        type="date"
                                        name="fechaRecepcion"
                                        value="<?= $response['data'][0]['fechaRecepcion']?>"
                                        readonly
                                >
                            </div>
                            <div>
                                <label>Hora Recepción</label>
                                <input
                                        type="text"
                                        name="horaRecepcion"
                                        value="<?= $response['data'][0]['hora recepcion']?>"
                                        readonly
                                >
                            </div>
                            <div>
                                <label>Usuario Destino</label>
                                <input
                                        type="text"
                                        name="usuarioOrigen"
                                        value="<?= $response['data'][0]['usuario destino']?>"
                                        readonly
                                >
                            </div>
                            <div>
                                <label>Estado Recepción</label>
                                <div class="estadosDetalle">
                                    <?php if ($response['data'][0]['estado recepcion'] == 'e'): ?>
                                        <span class="estado recepcionado"> Recepcionado </span>
                                        <span class="estado enviado"> Enviado </span>
                                    <?php endif; ?>
                                    <?php if ($response['data'][0]['estado recepcion'] == 'a'): ?>
                                        <span class="estado recepcionado"> Recepcionado </span>
                                    <?php endif; ?>
                                    <?php if ($response['data'][0]['estado recepcion'] == 'i'): ?>
                                        <span class="estado pendienteRecepcion"> Pendiente de Recepción </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="containerObservacion">
                        <div>
                            <label>Observación</label>
                            <textarea
                                    class="disabled"
                                    name="observacion"
                                    readonly>
                            <?= $response['data'][0]['observaciones']?>
                        </textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


