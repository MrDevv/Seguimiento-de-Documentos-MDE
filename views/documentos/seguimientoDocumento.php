
<div class="containerSeguimiento">
    <div class="seguimiento_header">
        <h2>Ver Seguimiento de un Documento</h2>
    </div>
    <div class="seguimiento_body">
        <?php if (!$response['data']):?>
            <p class="mensajeSinRegistros">
                El documento aún no ha sido enviado. Una vez que el documento sea enviado, podrá seguir su estado de seguimiento aquí.
            </p>
        <?php else: ?>
            <div class="infoGeneral">
                <div class="containerInfoDoc">
                    <p>N° Documento: <span> <?= $response['data'][0]['NumDocumento']?></span></p>
                    <p>Tipo Documento: <span>  <?= $response['data'][0]['tipo documento']?></span></p>
                </div>
                <div
                        class="containerEstadoDoc"
                >
                    <p>Estado Documento:
                        <span class="estado <?= $response['data'][0]['Estado Documento'] == 'a' ? 'follow' : 'finished'?>">
                            <?= $response['data'][0]['Estado Documento'] == 'a' ? 'En Seguimiento' : 'Finalizado'?>
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
                <tbody>
                <?php if (count($response['data']) == 0): ?>
                    <tr>
                        <td colspan="10" class="mensajeSinRegistros"> Aún no existen registros </td>
                    </tr>

                <?php else: ?>
                    <?php foreach ($response['data'] as $index => $result): ?>
                        <tr>
                            <td> <?= $index + 1 ?> </td>
                            <td> <?= $result['folios'] ?> </td>
                            <td> <?= $result["area origen"] ?> </td>
                            <td> <?= $result["usuario origen"] ?> </td>
                            <td> <?= $result["fechaEnvio"] ?> </td>
                            <td class="columArrow"> <svg fill="#056251" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg> </td>
                            <td> <?= $result["area destino"] ?> </td>
                            <td> <?= $result["usuario destino"] ?> </td>
                            <td> <?= $result["fechaRecepcion"] ?> </td>
                            <td> <?= $result["observaciones"] ?> </td>
                            <td>
                            <span class="estado <?= $result["estado recepcion"] == 'i' ? "pendienteRecepcion" : "recepcionado" ?> ">
                                <?= $result["estado recepcion"] == 'i' ? "Pendiente de Recepcion" : "Recepcionado" ?>
                            </span>
                            </td>
                            <td class="actions">
                                <a href="<?=base_url?>envio/detalle?cod=<?=$result["codEnvio"]?>" class="action">
                                    <span class="tooltip">Ver Detalle <span class="triangulo"></span></span>
                                    <svg width="36" height="34" viewBox="0 0 36 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g filter="url(#filter0_d_2424_29)">
                                            <rect x="4" width="28" height="26" rx="5" fill="white"/>
                                            <path d="M27.3334 3.25H8.66671C7.37987 3.25 6.33337 4.22175 6.33337 5.41667V20.5833C6.33337 21.7783 7.37987 22.75 8.66671 22.75H27.3334C28.6202 22.75 29.6667 21.7783 29.6667 20.5833V5.41667C29.6667 4.22175 28.6202 3.25 27.3334 3.25ZM8.66671 20.5833V5.41667H27.3334L27.3357 20.5833H8.66671Z" fill="black"/>
                                            <path d="M11 7.5835H25V9.75016H11V7.5835ZM11 11.9168H25V14.0835H11V11.9168ZM11 16.2502H18V18.4168H11V16.2502Z" fill="black"/>
                                        </g>
                                        <defs>
                                            <filter id="filter0_d_2424_29" x="0" y="0" width="36" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                <feOffset dy="4"/>
                                                <feGaussianBlur stdDeviation="2"/>
                                                <feComposite in2="hardAlpha" operator="out"/>
                                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2424_29"/>
                                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2424_29" result="shape"/>
                                            </filter>
                                        </defs>
                                    </svg>

                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</div>