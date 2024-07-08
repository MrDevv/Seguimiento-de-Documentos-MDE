
<div class="containerPendientesRecepcion">
    <div class="pendientesRecepcion_header">
        <h2>GESTION DE DOCUMENTOS</h2>
        <p>Listado de Documentos</p>
    </div>
    <div class="listadoDocumentos_body">
        <table>
            <thead>
            <tr>
                <th>Nro Documento</th>
                <th>Tipo Documento</th>
                <th>Asunto</th>
                <th>Folios</th>
                <th>Fecha Registro</th>
                <th>Usuario Registrador</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($response['data'] as $result):?>
                <!--            --><?php //var_dump($result); ?>
                <tr>
                    <td> <?=$result["NumDocumento"]?> </td>
                    <td> <?=$result["tipo documento"]?> </td>
                    <td class="asuntoDocumento"> <?=$result["asunto"]?> </td>
                    <td> <?=$result["folios"]?> </td>
                    <td> <?=$result["fechaRegistro"]?> </td>
                    <td> <?=$result["usuario registrador"]?> </td>
                    <td>
                        <span
                                class="estado
                                    <?php if ($result["estado"] == 'a'): ?>
                                        <?= 'follow' ?>
                                    <?php elseif($result["estado"] == 'i'): ?>
                                        <?=  'finished' ?>
                                    <?php else: ?>
                                        <?=  'new' ?>
                                    <?php endif;?>
                                "
                        >
                            <?php if ($result["estado"] == 'a'): ?>
                                <?= 'En seguimiento' ?>
                            <?php elseif($result["estado"] == 'i'): ?>
                                <?= 'Seguimiento finalizado' ?>
                            <?php else: ?>
                                <?= 'Pendiente de envio' ?>
                            <?php endif;?>
                        </span>
                    </td>
                    <td class="actions">
                        <?php if ($result['estado'] == 'n'):?>
                            <a class="action" href="<?=base_url?>documento/editar?doc=<?=$result["NumDocumento"]?>">
                                <span class="tooltip">Enviar documento <span class="triangulo"></span></span>
                                <svg width="36" height="34" viewBox="0 0 36 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g filter="url(#filter0_d_2426_28)">
                                        <g clip-path="url(#clip0_2426_28)">
                                            <rect x="2" width="30" height="26" rx="5" fill="white"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.4887 6.51097L8.74874 11.4434L13.9925 14.0737L18.6162 10.0654C18.8508 9.86225 19.1688 9.74819 19.5004 9.74829C19.832 9.7484 20.15 9.86265 20.3844 10.0659C20.6188 10.2692 20.7504 10.5449 20.7502 10.8322C20.7501 11.1196 20.6183 11.3952 20.3837 11.5983L15.7587 15.6066L18.7962 20.1501L24.4887 6.51097ZM24.8925 4.07997C26.3862 3.61089 27.8337 4.86539 27.2925 6.15997L20.69 21.9821C20.1475 23.2799 18.1025 23.4381 17.3037 22.2431L13.2825 16.222L6.33499 12.7369C4.95624 12.0446 5.13874 10.2723 6.63624 9.80214L24.8925 4.07997Z" fill="#0C7260"/>
                                        </g>
                                    </g>
                                    <defs>
                                        <filter id="filter0_d_2426_28" x="-2" y="0" width="38" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                            <feOffset dy="4"/>
                                            <feGaussianBlur stdDeviation="2"/>
                                            <feComposite in2="hardAlpha" operator="out"/>
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2426_28"/>
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2426_28" result="shape"/>
                                        </filter>
                                        <clipPath id="clip0_2426_28">
                                            <rect x="2" width="30" height="26" rx="5" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <a class="action" href="<?=base_url?>documento/editar?doc=<?=$result["NumDocumento"]?>">
                                <span class="tooltip">Editar <span class="triangulo"></span></span>
                                <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                            </a>
                        <?php endif;?>

                        <?php if ($result['estado'] == 'a'):?>
                        <a class="action" href="<?=base_url?>documento/editar?doc=<?=$result["NumDocumento"]?>">
                            <span class="tooltip">Editar <span class="triangulo"></span></span>
                            <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                        </a>
                        <?php endif;?>

                        <?php if ($result['estado'] == 'a'):?>
                        <div class="action" onclick="modalFinalizarSeguimientoDocumento(<?=$result["NumDocumento"]?>)">
                            <span class="tooltip">Dar por Culminado <span class="triangulo"></span></span>
                            <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M32 0C49.7 0 64 14.3 64 32V48l69-17.2c38.1-9.5 78.3-5.1 113.5 12.5c46.3 23.2 100.8 23.2 147.1 0l9.6-4.8C423.8 28.1 448 43.1 448 66.1V345.8c0 13.3-8.3 25.3-20.8 30l-34.7 13c-46.2 17.3-97.6 14.6-141.7-7.4c-37.9-19-81.3-23.7-122.5-13.4L64 384v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V400 334 64 32C0 14.3 14.3 0 32 0zM64 187.1l64-13.9v65.5L64 252.6V318l48.8-12.2c5.1-1.3 10.1-2.4 15.2-3.3V238.7l38.9-8.4c8.3-1.8 16.7-2.5 25.1-2.1l0-64c13.6 .4 27.2 2.6 40.4 6.4l23.6 6.9v66.7l-41.7-12.3c-7.3-2.1-14.8-3.4-22.3-3.8v71.4c21.8 1.9 43.3 6.7 64 14.4V244.2l22.7 6.7c13.5 4 27.3 6.4 41.3 7.4V194c-7.8-.8-15.6-2.3-23.2-4.5l-40.8-12v-62c-13-3.8-25.8-8.8-38.2-15c-8.2-4.1-16.9-7-25.8-8.8v72.4c-13-.4-26 .8-38.7 3.6L128 173.2V98L64 114v73.1zM320 335.7c16.8 1.5 33.9-.7 50-6.8l14-5.2V251.9l-7.9 1.8c-18.4 4.3-37.3 5.7-56.1 4.5v77.4zm64-149.4V115.4c-20.9 6.1-42.4 9.1-64 9.1V194c13.9 1.4 28 .5 41.7-2.6l22.3-5.2z"/></svg>
                        </div>
                        <?php endif;?>

                        <?php if ($result['estado'] == 'i'):?>
                        <div class="action" onclick="modalReanudarSeguimientoDocumento(<?=$result["NumDocumento"]?>)">
                            <span class="tooltip">Continuar seguimiento <span class="triangulo"></span></span>
                            <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM241 119c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l31 31H120c-13.3 0-24 10.7-24 24s10.7 24 24 24H238.1l-31 31c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l72-72c9.4-9.4 9.4-24.6 0-33.9l-72-72z"/></svg>
                        </div>
                        <?php endif;?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>