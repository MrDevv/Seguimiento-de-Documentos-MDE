
<div class="containerDetalle">
    <div class="seguimiento_header">
        <h2>Detalle del Envio</h2>
    </div>
    <div class="seguimiento_body">
            <div class="infoGeneral">
                <div class="containerInfoDoc">
                    <p>N° Documento: <span> <?= $response['data'][0]['NumDocumento']?></span></p>
                    <p>Tipo Documento: <span>  <?= $response['data'][0]['tipo documento']?></span></p>
                    <p>Folios: <span>  <?= $response['data'][0]['folios']?></span></p>
                </div>
                <div
                    class="containerEstadoDoc"
                >
                    <p>Estado Documento:
                        <span class="estado <?= $response['data'][0]['estado documento'] == 'a' ? 'follow' : 'finished'?>">
                            <?= $response['data'][0]['estado documento'] == 'a' ? 'En Seguimiento' : 'Finalizado'?>
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