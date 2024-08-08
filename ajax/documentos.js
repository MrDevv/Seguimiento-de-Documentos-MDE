$(document).ready(function(){
    function loadDocumentos(numDocumento = null) {

        $.ajax({
            url: './controllers/documento/listarDocumentos.php',
            method: 'POST',
            dataType: 'json',
            data: {numDocumento},
            success: function(response) {
                console.log(response)

                let {data} = response
                console.log(data)
                if (data.length > 0 && Array.isArray(data)) {
                    let row = data.map(documento => `
                    <tr>
                        <td>${documento.NumDocumento}</td>
                        <td class="invisible">${documento.codTipoDocumento}</td>
                        <td>${documento['tipo documento']}</td>
                        <td class="asuntoDocumento">${documento.asunto}</td>
                        <td>${documento.folios}</td>
                        <td>${documento.fechaRegistro}</td>
                        <td>${documento["usuario registrador"]}</td>
                        <td>${documento.area}</td>
                        <td class="invisible">${documento.estado}</td>
                        <td>
                            <span class="estado ${documento.estado === 'a' ? 'follow' : documento.estado === 'i' ? 'finished' : 'new'}">
                                ${documento.estado === 'a' ? 'En seguimiento' : documento.estado === 'i' ? 'Seguimiento finalizado' : 'Pendiente de envío'}
                            </span>
                        </td>
                        <td>
                        <div class="actions">
                             ${documento.estado == 'n' ? `
                                    <a class="action" id="btnEnviarDocumento" href="#">
                                        <span class="tooltipParent">Enviar documento <span class="triangulo"></span></span>
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
                                    <a class="action" id="btnEditarDocumento" href="#">
                                        <span class="tooltipParent">Editar <span class="triangulo"></span></span>
                                        <svg width="36" height="34" viewBox="0 0 38 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_2868_2)">
                                                <rect x="4" width="30" height="26" rx="5" fill="white"/>
                                                <path d="M12.75 7.58301H11.5C10.837 7.58301 10.2011 7.81128 9.73223 8.21761C9.26339 8.62394 9 9.17504 9 9.74967V19.4997C9 20.0743 9.26339 20.6254 9.73223 21.0317C10.2011 21.4381 10.837 21.6663 11.5 21.6663H22.75C23.413 21.6663 24.0489 21.4381 24.5178 21.0317C24.9866 20.6254 25.25 20.0743 25.25 19.4997V18.4163" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M24 5.41678L27.75 8.66678M29.4813 7.13387C29.9736 6.7072 30.2501 6.12851 30.2501 5.52512C30.2501 4.92172 29.9736 4.34303 29.4813 3.91637C28.9889 3.4897 28.3212 3.25 27.625 3.25C26.9288 3.25 26.2611 3.4897 25.7688 3.91637L15.25 13.0001V16.2501H19L29.4813 7.13387Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </g>
                                            <defs>
                                                <filter id="filter0_d_2868_2" x="0" y="0" width="38" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                    <feOffset dy="4"/>
                                                    <feGaussianBlur stdDeviation="2"/>
                                                    <feComposite in2="hardAlpha" operator="out"/>
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2868_2"/>
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2868_2" result="shape"/>
                                                </filter>
                                            </defs>
                                        </svg>
                                    </a>
                                    ` : ''
                            }    
            
                            ${documento.estado == 'i' && (localStorage.getItem('rol') == 'administrador' || localStorage.getItem('rol') == 'administrador área') ? `
                                <a class="action" id="btnContinuarDocumento" href="#">
                                    <span class="tooltipParent">Continuar seguimiento <span class="triangulo"></span></span>
                                    <svg width="37" height="34" viewBox="0 0 37 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g filter="url(#filter0_d_2991_2)">
                                        <rect x="4" width="29" height="26" rx="5" fill="#F8F8F8"/>
                                        <path d="M24.4383 10.7176C24.4383 12.4207 23.8853 13.9939 22.9538 15.2703L27.6521 19.9713C28.116 20.4351 28.116 21.1884 27.6521 21.6522C27.1882 22.116 26.4348 22.116 25.9709 21.6522L21.2727 16.9511C19.996 17.8861 18.4225 18.4352 16.7191 18.4352C12.4551 18.4352 9 14.9809 9 10.7176C9 6.45438 12.4551 3 16.7191 3C20.9832 3 24.4383 6.45438 24.4383 10.7176ZM17.9438 7.41537C17.595 7.06659 17.0309 7.06659 16.6857 7.41537C16.3406 7.76415 16.3369 8.32813 16.6857 8.67319L17.8362 9.82341L13.4533 9.82712C12.9598 9.82712 12.5627 10.2241 12.5627 10.7176C12.5627 11.2111 12.9598 11.6081 13.4533 11.6081H17.8362L16.6857 12.7583C16.3369 13.1071 16.3369 13.6711 16.6857 14.0162C17.0346 14.3612 17.5987 14.3649 17.9438 14.0162L20.6158 11.3447C20.9646 10.9959 20.9646 10.4319 20.6158 10.0869L17.9438 7.41537Z" fill="black"/>
                                        </g>
                                        <defs>
                                        <filter id="filter0_d_2991_2" x="0" y="0" width="37" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feOffset dy="4"/>
                                        <feGaussianBlur stdDeviation="2"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2991_2"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2991_2" result="shape"/>
                                        </filter>
                                        </defs>
                                    </svg>
                                </a>
                            ` : ''}
                            
                            ${documento.estado == 'a' && (localStorage.getItem('rol') == 'administrador' || localStorage.getItem('rol') == 'administrador área') ? `
                                <a class="action" id="btnCulminarDocumento" href="#">
                                    <span class="tooltipParent">Dar por Culminado <span class="triangulo"></span></span>
                                    <svg width="37" height="34" viewBox="0 0 37 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g filter="url(#filter0_d_2984_8)">
                                        <rect x="4" width="29" height="26" rx="5" fill="#F8F8F8"/>
                                        <path d="M21.4 7H27V17H20L19.6 15H14V22H12V5H21L21.4 7ZM21 15H23V13H25V11H23V9H21V11L20 9V7H18V9H16V7H14V9H16V11H14V13H16V11H18V13H20V11L21 13V15ZM18 11V9H20V11H18ZM21 11H23V13H21V11Z" fill="black"/>
                                        </g>
                                        <defs>
                                        <filter id="filter0_d_2984_8" x="0" y="0" width="37" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feOffset dy="4"/>
                                        <feGaussianBlur stdDeviation="2"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2984_8"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2984_8" result="shape"/>
                                        </filter>
                                        </defs>
                                    </svg>
                                </a>` : ''}
                            
                            <a href="" class="action" id="btnSeguimientoDocumento" href="#">
                            <span class="tooltipParent">Ver Seguimiento <span class="triangulo"></span></span>
                            <svg width="39" height="34" viewBox="0 0 39 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_2424_32)">
                                    <rect x="4" width="31" height="26" rx="5" fill="#F8F8F8"/>
                                    <path d="M29.7578 24.2068H9.23569C8.84397 24.2066 8.46834 24.0851 8.19122 23.869C7.9141 23.6528 7.75814 23.3597 7.75757 23.0538V2.94815C7.75757 2.3112 8.4206 1.79297 9.23569 1.79297H29.7585C30.4504 1.79297 31.0327 2.16546 31.1949 2.66681H31.2395L31.2424 2.94815V23.0538C31.2407 23.3603 31.0835 23.6537 30.8052 23.8698C30.5269 24.0859 30.1503 24.2071 29.7578 24.2068ZM9.23569 2.35565C8.81769 2.35565 8.47825 2.6218 8.47825 2.94815V23.0538C8.47825 23.3791 8.81769 23.6441 9.23569 23.6441H29.7585C30.1794 23.6441 30.5217 23.3791 30.5217 23.0538L30.5181 2.94815C30.5181 2.6218 30.1772 2.35565 29.7578 2.35565H9.23569Z" fill="black"/>
                                    <path d="M17.8628 9.86244H9.98647C9.89362 9.86244 9.80456 9.82734 9.7389 9.76486C9.67324 9.70239 9.63635 9.61766 9.63635 9.5293C9.63635 9.44095 9.67324 9.35622 9.7389 9.29374C9.80456 9.23127 9.89362 9.19617 9.98647 9.19617H17.8628C17.9557 9.19617 18.0447 9.23127 18.1104 9.29374C18.1761 9.35622 18.2129 9.44095 18.2129 9.5293C18.2129 9.61766 18.1761 9.70239 18.1104 9.76486C18.0447 9.82734 17.9557 9.86244 17.8628 9.86244ZM17.8628 11.5987H9.98647C9.89362 11.5987 9.80456 11.5636 9.7389 11.5012C9.67324 11.4387 9.63635 11.3539 9.63635 11.2656C9.63635 11.1772 9.67324 11.0925 9.7389 11.03C9.80456 10.9676 9.89362 10.9325 9.98647 10.9325H17.8628C17.9557 10.9325 18.0447 10.9676 18.1104 11.03C18.1761 11.0925 18.2129 11.1772 18.2129 11.2656C18.2129 11.3539 18.1761 11.4387 18.1104 11.5012C18.0447 11.5636 17.9557 11.5987 17.8628 11.5987ZM17.8628 15.0686H9.98647C9.89362 15.0686 9.80456 15.0335 9.7389 14.9711C9.67324 14.9086 9.63635 14.8239 9.63635 14.7355C9.63635 14.6472 9.67324 14.5624 9.7389 14.4999C9.80456 14.4375 9.89362 14.4024 9.98647 14.4024H17.8628C17.9557 14.4024 18.0447 14.4375 18.1104 14.4999C18.1761 14.5624 18.2129 14.6472 18.2129 14.7355C18.2129 14.8239 18.1761 14.9086 18.1104 14.9711C18.0447 15.0335 17.9557 15.0686 17.8628 15.0686ZM17.8628 13.333H9.98647C9.89362 13.333 9.80456 13.2979 9.7389 13.2354C9.67324 13.173 9.63635 13.0882 9.63635 12.9999C9.63635 12.9115 9.67324 12.8268 9.7389 12.7643C9.80456 12.7018 9.89362 12.6667 9.98647 12.6667H17.8628C17.9557 12.6667 18.0447 12.7018 18.1104 12.7643C18.1761 12.8268 18.2129 12.9115 18.2129 12.9999C18.2129 13.0882 18.1761 13.173 18.1104 13.2354C18.0447 13.2979 17.9557 13.333 17.8628 13.333ZM17.8628 16.8036H9.98647C9.89362 16.8036 9.80456 16.7685 9.7389 16.706C9.67324 16.6435 9.63635 16.5588 9.63635 16.4705C9.63635 16.3821 9.67324 16.2974 9.7389 16.2349C9.80456 16.1724 9.89362 16.1373 9.98647 16.1373H17.8628C17.9557 16.1373 18.0447 16.1724 18.1104 16.2349C18.1761 16.2974 18.2129 16.3821 18.2129 16.4705C18.2129 16.5588 18.1761 16.6435 18.1104 16.706C18.0447 16.7685 17.9557 16.8036 17.8628 16.8036ZM24.1804 17.9309C21.322 17.9309 18.9972 15.7189 18.9972 12.9992C18.9972 10.2802 21.322 8.06885 24.1804 8.06885C27.0388 8.06885 29.3636 10.2802 29.3636 12.9992C29.3636 15.7189 27.0388 17.9309 24.1804 17.9309ZM24.1804 8.73511C22.992 8.73617 21.8526 9.18572 21.0122 9.98513C20.1718 10.7845 19.6989 11.8685 19.6975 12.9992C19.6975 15.3511 21.7086 17.2647 24.1804 17.2647C26.6523 17.2647 28.6634 15.3511 28.6634 12.9992C28.6634 10.648 26.6523 8.73511 24.1804 8.73511Z" fill="black"/>
                                    <path d="M24.2002 17.0343C22.3524 17.0343 20.6865 15.8591 20.1494 14.1767L20.8213 13.9817C21.2692 15.3847 22.6578 16.3643 24.1995 16.3643C24.9556 16.3674 25.6925 16.1371 26.3002 15.7077C26.9079 15.2783 27.3538 14.6728 27.5713 13.9817L28.2431 14.1767C27.9824 15.0055 27.4478 15.7315 26.7191 16.2465C25.9905 16.7616 25.1069 17.0379 24.2002 17.0343ZM28.0733 13.3345H27.6176C27.5245 13.3345 27.4353 13.2992 27.3694 13.2363C27.3036 13.1735 27.2666 13.0883 27.2666 12.9995C27.2666 12.9106 27.3036 12.8254 27.3694 12.7626C27.4353 12.6998 27.5245 12.6645 27.6176 12.6645H27.7047C27.5278 10.966 26.0226 9.63534 24.1966 9.63534C22.3707 9.63534 20.8655 10.966 20.6886 12.6645H20.8157C20.9088 12.6645 20.998 12.6998 21.0639 12.7626C21.1297 12.8254 21.1667 12.9106 21.1667 12.9995C21.1667 13.0883 21.1297 13.1735 21.0639 13.2363C20.998 13.2992 20.9088 13.3345 20.8157 13.3345H20.3207C20.2276 13.3345 20.1384 13.2992 20.0725 13.2363C20.0067 13.1735 19.9697 13.0883 19.9697 12.9995C19.9697 10.775 21.8659 8.96533 24.1966 8.96533C26.5274 8.96533 28.4243 10.775 28.4243 12.9995C28.4243 13.0883 28.3873 13.1735 28.3215 13.2363C28.2556 13.2992 28.1664 13.3345 28.0733 13.3345Z" fill="black"/>
                                    <path d="M24.1524 9.92513C24.0532 9.92513 23.9581 9.8959 23.888 9.84388C23.8178 9.79186 23.7784 9.7213 23.7784 9.64773V9.24273C23.7784 9.16916 23.8178 9.0986 23.888 9.04658C23.9581 8.99456 24.0532 8.96533 24.1524 8.96533C24.2516 8.96533 24.3467 8.99456 24.4168 9.04658C24.487 9.0986 24.5264 9.16916 24.5264 9.24273V9.64773C24.5264 9.7213 24.487 9.79186 24.4168 9.84388C24.3467 9.8959 24.2516 9.92513 24.1524 9.92513ZM26.6999 10.7584C26.626 10.7583 26.5537 10.7419 26.4924 10.7114C26.431 10.6808 26.3832 10.6375 26.355 10.5867C26.3268 10.536 26.3195 10.4803 26.3341 10.4265C26.3486 10.3727 26.3843 10.3234 26.4366 10.2846L26.8517 9.97784C26.9225 9.92743 27.017 9.89966 27.1151 9.90049C27.2132 9.90131 27.3069 9.93069 27.376 9.98227C27.4452 10.0339 27.4842 10.1035 27.4848 10.1763C27.4854 10.249 27.4474 10.319 27.379 10.3712L26.9639 10.678C26.8936 10.7295 26.7987 10.7584 26.6999 10.7584ZM21.6924 10.7584C21.5932 10.7584 21.498 10.7293 21.4276 10.6774L21.014 10.3706C20.9459 10.3183 20.9082 10.2482 20.9091 10.1755C20.9099 10.1028 20.9493 10.0332 21.0186 9.98177C21.0879 9.93034 21.1817 9.90116 21.2798 9.90053C21.3778 9.8999 21.4723 9.92786 21.5428 9.97839L21.9564 10.2852C22.0086 10.324 22.0441 10.3734 22.0584 10.4271C22.0728 10.4808 22.0654 10.5365 22.0371 10.5871C22.0089 10.6377 21.9611 10.681 21.8998 10.7115C21.8384 10.742 21.7663 10.7583 21.6924 10.7584Z" fill="black"/>
                                    <path d="M24.2057 16.1382C23.8346 16.1376 23.4789 15.9994 23.2167 15.7538C22.9544 15.5081 22.807 15.1752 22.8068 14.828L22.7878 14.757L22.8097 14.7515L23.6654 10.2768C23.6897 10.1602 23.7565 10.0551 23.8544 9.97949C23.9523 9.90389 24.0752 9.86247 24.2022 9.86231C24.3291 9.86214 24.4522 9.90326 24.5503 9.97861C24.6484 10.054 24.7155 10.1589 24.7401 10.2754C25.606 14.6812 25.606 14.7877 25.606 14.8274C25.6058 15.1748 25.4583 15.508 25.1957 15.7538C24.9332 15.9996 24.5771 16.1378 24.2057 16.1382ZM23.5369 14.8274C23.5369 15.1737 23.837 15.4551 24.2057 15.4551C24.3833 15.4547 24.5536 15.3886 24.6792 15.271C24.8048 15.1535 24.8755 14.9942 24.8759 14.828C24.8584 14.6962 24.5123 12.9045 24.205 11.3328L23.5369 14.8274Z" fill="black"/>
                                </g>
                                <defs>
                                    <filter id="filter0_d_2424_32" x="0" y="0" width="39" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feOffset dy="4"/>
                                        <feGaussianBlur stdDeviation="2"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2424_32"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2424_32" result="shape"/>
                                    </filter>
                                </defs>
                            </svg>
                        </a>
                        </div>             
                        </td>
                    </tr>`).join('');
                $('#bodyListaDocumentos').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros"> Aún no existen documentos registrados</td>
                    </tr>`
                    $('#bodyListaDocumentos').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    loadDocumentos()


    // buscarDocumentos
    $(document).off("click", "#filtrarPorDocumentoListadoDocumentos").on("click", "#filtrarPorDocumentoListadoDocumentos", function(e){
        e.preventDefault();

        let numDocumento = $('#numDocumentoListadoDocumentos').val();

        if (numDocumento.length == 0 || !numDocumento){
            numDocumento = null;
        }

        loadDocumentos(numDocumento);
    })

    // nuevo Envio
    $(document).off("click", "#btnEnviarDocumento").on("click", "#btnEnviarDocumento", function(e){
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarEnvio");
        $("#registrarEnvioForm").trigger("reset");
        let fila = $(this).closest("tr");

        let numDocumento = fila.find('td:eq(0)').text();

        $("#nroDocumentoEnvio").val(numDocumento.trim());

        modalRegistrar.modal({
            backdrop: 'static', // Evita que se cierre al hacer clic fuera del modal
            keyboard: false // Evita que se cierre al presionar la tecla Esc
        });

        modalRegistrar.modal('show');

        modalRegistrar.on('shown.bs.modal', function () {
            $("#foliosEnvio").focus();
        });
    });

    // filtrar usuarios por area
    $('#areaEnvio').change(function() {
        let codArea = $('#areaEnvio').val();

        $.ajax({
            url: './controllers/usuario/obtenerUsuariosPorArea.php',
            method: 'POST',
            dataType: 'json',
            data: {codArea},
            success: function(response) {
                let {data, status, message} = response;
                if (message == "no se encontraron usuarios en esta area" && codArea != "0" && localStorage.getItem("rol") == 'administrador'){
                    Swal.fire({
                        title: "¡Advertencia!",
                        text: response.message + ', puede registrar un usuario dando click en el botón "Registrar nuevo Usuario".',
                        icon: "warning",
                        confirmButtonColor: "#056251",
                    }).then(()=>{
                        let options = `<option value="0">Seleccionar</option>`;
                        $('.selectUsuarioDestino').html(options);
                    });
                } else if(message == "no se encontraron usuarios en esta area" && codArea != "0" && (localStorage.getItem("rol") == 'usuario' || localStorage.getItem("rol") == 'administrador área')){
                    Swal.fire({
                        title: "¡Advertencia!",
                        text: response.message + ' comuniquese con un administrador.',
                        icon: "warning",
                        confirmButtonColor: "#056251",
                    }).then(()=>{
                        let options = `<option value="0">Seleccionar</option>`;
                        $('.selectUsuarioDestino').html(options);
                    });
                }else {
                    let options = `<option value="0">Seleccionar</option>` + // Agregar la opción "Seleccionar"
                        data.map(usuario =>
                            `<option value="${usuario.codUsuarioArea}">${usuario.usuario}</option>`
                        ).join('');

                    // Actualizar el contenido del select
                    $('.selectUsuarioDestino').html(options);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    });


    // registrar envio
    $('#registrarEnvioForm').submit( function (e) {
        e.preventDefault();

        let codRecepcion = $.trim($('#codRecepcion').val());
        let numDocumento = $.trim($('#nroDocumentoEnvio').val());
        let folios = $.trim($('#foliosEnvio').val());
        let movimiento = $.trim($('#movimientoEnvio').val());
        let usuarioAreaDestino = $.trim($('#usuarioDestino').val());
        let observacion = $.trim($('#observacionEnvio').val());


        if(numDocumento.length == 0 || folios.length == 0 || movimiento.length == 0 || movimiento == '0' || usuarioAreaDestino.length == 0
            || usuarioAreaDestino == '0'){
            Swal.fire({
                icon: "warning",
                title: "Campos Incompletos",
                text: "Ingrese los campos requeridos",
            });
            return;
        }

        console.log({codRecepcion, nroDocumentoEnvio: numDocumento, foliosEnvio: folios, movimientoEnvio: movimiento, usuarioDestino: usuarioAreaDestino, observacionEnvio: observacion})

        $.ajax({
            url: "./controllers/envio/registrarEnvio.php",
            type: "POST",
            dataType: "json",
            data: {codRecepcion, numDocumento, folios, movimiento, usuarioAreaDestino, observacion},
            success: function (response) {
                console.log(response);
                if (response.status == 'success'){
                    Swal.fire({
                        icon: "success",
                        title: "Registro Exitoso",
                        text: "Se registro correctamente el usuario"
                    }).then(() => {
                        $('#modalRegistrarEnvio').modal('hide');
                        loadDocumentos()
                    })
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message + response.info
                    })
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        })
    } )

    // nuevo
    $(document).on("click", "#btnNuevoRegistro", function(e){
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarDocumento");
        $("#registrarDocumentoForm").trigger("reset");

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        }).modal('show');

        modalRegistrar.on('shown.bs.modal', function () {
            $("#nroDocumentoRegistro").focus();
        });
    });


    // registrar documento
    $('#registrarDocumentoForm').submit(function(e){
        e.preventDefault();
        let numDocumento = $.trim($('#nroDocumentoRegistro').val());
        let tipoDocumento = $.trim($('#tipoDocumentoRegistro').val());
        let folios = $.trim($('#foliosRegistro').val());
        let asunto = $.trim($('#asuntoRegistro').val());

        if(numDocumento.length == 0 || tipoDocumento.length == 0 || tipoDocumento == 0 || folios.length == 0 || asunto.length == 0){
            Swal.fire({
                icon: "warning",
                title: "Campos Incompletos",
                text: "Ingrese los campos requeridos",
            });
            return;
        }

        $.ajax({
            url: "./controllers/documento/registrarDocumento.php",
            type: "POST",
            datatype: "json",
            data: {numDocumento, tipoDocumento, folios, asunto},
            success: function(response) {
                response = JSON.parse(response);
                if (response.message == 'documento encontrado'){
                    Swal.fire({
                        icon: "warning",
                        title: "¡Advertencia!",
                        text: "El documento que intenta registrar ya existe"
                    });
                } else {
                    if (response.status == 'success'){
                        Swal.fire({
                            icon: "success",
                            title: "¡Éxito!",
                            text: response.message
                        }).then(() => {
                            $('#modalRegistrarDocumento').modal('hide');
                            loadDocumentos()
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response.message + ' ' + response.info
                        });
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error updating the area:', textStatus, errorThrown);
            }
        });
    });

    // editar
    $(document).on("click", "#btnEditarDocumento", function(e){
        e.preventDefault();
        let modalActualizar = $("#modalEditarDocumento");
        let fila = $(this).closest("tr");
        let numDocumento = fila.find('td:eq(0)').text();
        let tipoDocumento = fila.find('td:eq(1)').text();
        let asunto = fila.find('td:eq(3)').text();
        let folios = fila.find('td:eq(4)').text();
        $("#nroDocumentoEditar").val(numDocumento);
        $("#tipoDocumentoEditar").val(tipoDocumento);
        $("#foliosEditar").val(folios);
        $("#asuntoEditar").val(asunto);

        modalActualizar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalActualizar.modal('show');

        modalActualizar.on('shown.bs.modal', function () {
            $("#foliosEditar").focus();
        });
    });

    // actualizar documento
    $('#editarDocumentoForm').submit(function(e){
        e.preventDefault();
        let numDocumento = $.trim($('#nroDocumentoEditar').val());
        let tipoDocumento = $.trim($('#tipoDocumentoEditar').val());
        let folios = $.trim($('#foliosEditar').val());
        let asunto = $.trim($('#asuntoEditar').val());

        if(numDocumento.length == 0 || tipoDocumento.length == 0 || tipoDocumento == 0 || folios.length == 0 || asunto.length == 0){
            Swal.fire({
                icon: "warning",
                title: "Campos Incompletos",
                text: "Ingrese los campos requeridos",
            });
            return;
        }

        $.ajax({
            url: "./controllers/documento/actualizarDocumento.php",
            type: "POST",
            datatype: "json",
            data: {numDocumento, tipoDocumento, folios, asunto},
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 'success'){
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: response.message
                    }).then(() => {
                        $('#modalEditarDocumento').modal('hide');
                        loadDocumentos()
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message + ' ' + response.info
                    });
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error updating the area:', textStatus, errorThrown);
            }
        });
    });

    // culminar seguimiento documento
    $(document).on("click", "#btnCulminarDocumento", function(e){
        e.preventDefault();
        let fila = $(this).closest("tr");
        let numDocumento = fila.find('td:eq(0)').text();

        Swal.fire({
            title: "¡Advertencia!",
            html: `¿Desea dar por culminado el seguimiento del documento <span style="color: red; font-weight: bold;">${numDocumento}</span>? Ya no se podrá enviar ni recepcionar.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#056251",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "./controllers/documento/culminarSeguimientoDocumento.php",
                    type: "POST",
                    dataType: "json",
                    data: {numDocumento},
                    success: function (response) {
                        if (response.status == 'success'){
                            Swal.fire({
                                icon: "success",
                                title: "¡Éxito!",
                                text: response.message
                            }).then(() => {
                               loadDocumentos()
                            })
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: response.message
                            })
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching the content:', textStatus, errorThrown);
                    }
                })


            }
        });



    });

    // continuar seguimiendo documento
    $(document).on("click", "#btnContinuarDocumento", function(e){
        e.preventDefault();
        let fila = $(this).closest("tr");
        let numDocumento = fila.find('td:eq(0)').text();

        Swal.fire({
            title: "¡Advertencia!",
            html: `¿Desea reanudar el seguimiento del documento <span style="color: red; font-weight: bold;">${numDocumento}</span>?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#056251",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "./controllers/documento/continuarSeguimientoDocumento.php",
                    type: "POST",
                    dataType: "json",
                    data: {numDocumento},
                    success: function (response) {
                        if (response.status == 'success'){
                            Swal.fire({
                                icon: "success",
                                title: "¡Éxito!",
                                text: response.message
                            }).then(() => {
                               loadDocumentos()
                            })
                        }else{
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: response.message
                            })
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching the content:', textStatus, errorThrown);
                    }
                })


            }
        });
    });

    // abrir modal para ver el seguimiento de un documento
    $(document).off("click", "#btnSeguimientoDocumento").on("click", "#btnSeguimientoDocumento", function(e){
        e.preventDefault();
        let fila = $(this).closest("tr");
        let numDocumento = fila.find('td:eq(0)').text();

        $.ajax({
            url: "./controllers/documento/obtenerSeguimiento.php",
            type: "POST",
            dataType: "json",
            data: {numDocumento},
            success: function (response) {
                let {status, data} = response
                console.log({info: "log de documentos.js - modal seguimiento" , response})
                if (status == 'success') {
                    if (data.length == 0) {
                        Swal.fire({
                            icon: "warning",
                            title: "¡Advertencia!",
                            text: "El documento aún no ha sido enviado. Una vez que el documento sea enviado, podrá seguir su seguimiento aquí."
                        })
                        return;
                    } else {
                        let modalVerSeguimiento = $("#modalSeguimientoDocumento");

                        let estadoDocumento = data[0]['Estado Documento']
                        let tipoDocumento = data[0]['tipo documento']

                        $("#numDocumentoSeguimiento").text(numDocumento);
                        $("#tipoDocumentoSeguimiento").text(tipoDocumento);

                        let estadoSpan = $("#estadoDocumentoSeguimiento");
                        estadoSpan.text(estadoDocumento === 'a' ? 'En Seguimiento' : 'Finalizado');
                        estadoSpan.removeClass('follow finished').addClass(estadoDocumento === 'a' ? 'estado follow' : 'estado finished');


                        if (data.length > 0 && Array.isArray(data)) {
                            let row = data.map((documento, index) => `
                                <tr>
                                    <td> ${index + 1} </td>
                                    <td> ${documento.folios} </td>
                                    <td> ${documento["area origen"]} </td>
                                    <td> ${documento["usuario origen"]} </td>
                                    <td> ${documento.fechaEnvio} </td>
                                    <td class="columArrow"> <svg fill="#056251" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg> </td>
                                    <td> ${documento["area destino"]} </td>
                                    <td> ${documento["usuario destino"]} </td>
                                    <td> ${documento.fechaRecepcion != null ? documento.fechaRecepcion : ''} </td>
                                    <td class="invisible"> ${documento.codEnvio} </td>
                                    <td class="observacionEnvio"> ${documento.observaciones} </td>
                                    <td>
                                        <span class="estado ${documento["estado recepcion"] == 'i' ? "pendienteRecepcion" : "recepcionado"} ">
                                            ${documento["estado recepcion"] == 'i' ? "Pendiente de Recepcion" : "Recepcionado"}
                                        </span>
                                    </td>
                                    <td>
                                    <div class="actions">
                                        <a href="#" class="action" id="btnDetalleEnvio">
                                            <span class="tooltipParent">Ver Detalle <span class="triangulo"></span></span>
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
                                    </div>
                                    </td>
                                </tr>
                                
                                `).join('');
                            $('#bodySeguimiento').html(row);

                            modalVerSeguimiento.modal({
                                backdrop: 'static', // Evita que se cierre al hacer clic fuera del modal
                                keyboard: false // Evita que se cierre al presionar la tecla Esc
                            });

                            modalVerSeguimiento.modal('show');
                        }
                    }
                }
                else
                    {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response.message
                        })
                    }
                },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        })

    });

    function capitalizeWords(str) {
        const exceptions = new Set(['y', 'de', 'a', 'en', 'o', 'con', 'para', 'por', 'que', 'si', 'el', 'la', 'los', 'las', 'un', 'una', 'del', 'al']);

        return str
            .toLowerCase()
            .split(' ')
            .map((word, index, array) => {
                if (index === 0 || !exceptions.has(word)) {
                    return word.charAt(0).toUpperCase() + word.slice(1);
                }
                return word;
            })
            .join(' ');
    }

})