$(document).ready(function() {

    function loadUsuarios(){
        $.ajax({
            url: './controllers/usuario/listarUsuario.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data)
                if (data && Array.isArray(data)) {
                    let row = data.map(usuario =>
                        `
                    <tr>
                        <td>${usuario.codUsuarioArea}</td>
                        <td class="invisible">${usuario.codUsuario}</td>
                        <td class="invisible">${usuario.codPersona}</td>
                        <td class="invisible">${usuario.codRol}</td>                      
                        <td>${usuario.usuario}</td>
                        <td>${usuario.rol}</td>
                        <td>${usuario.nombres}                        
                        <td>${usuario.apellidos}                        
                        <td>${usuario.dni}</td>
                        <td>${usuario.telefono}</td>                      
                        <td>${usuario.area}</td>
                        <td class="invisible">${usuario.codArea}</td>
                        <td>
                            <span class="estado ${usuario.estado === 'a' ? 'follow' : 'finished'}">
                                ${usuario.estado === 'a' ? 'Activo' : 'Inactivo'}
                            </span>
                        </td>
                        <td class="actions">
                            ${usuario.estado === 'a' ? `
                                <a class="action" id="btnEditarUsuario" href="#" data-bs-toggle="modal" data-bs-target="#modalEditarUsuario">
                                    <span class="tooltipParent">Editar <span class="triangulo"></span></span>
                                    <svg width="38" height="34" viewBox="0 0 38 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_2928_43)">
                                            <rect x="4" width="30" height="26" rx="5" fill="white"/>
                                            <path d="M12.75 7.58301H11.5C10.837 7.58301 10.2011 7.81128 9.73223 8.21761C9.26339 8.62394 9 9.17504 9 9.74967V19.4997C9 20.0743 9.26339 20.6254 9.73223 21.0317C10.2011 21.4381 10.837 21.6663 11.5 21.6663H22.75C23.413 21.6663 24.0489 21.4381 24.5178 21.0317C24.9866 20.6254 25.25 20.0743 25.25 19.4997V18.4163" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M24 5.41678L27.75 8.66678M29.4813 7.13387C29.9736 6.7072 30.2501 6.12851 30.2501 5.52512C30.2501 4.92172 29.9736 4.34303 29.4813 3.91637C28.9889 3.4897 28.3212 3.25 27.625 3.25C26.9288 3.25 26.2611 3.4897 25.7688 3.91637L15.25 13.0001V16.2501H19L29.4813 7.13387Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </g>
                                            <defs>
                                            <filter id="filter0_d_2928_43" x="0" y="0" width="38" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                            <feOffset dy="4"/>
                                            <feGaussianBlur stdDeviation="2"/>
                                            <feComposite in2="hardAlpha" operator="out"/>
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2928_43"/>
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2928_43" result="shape"/>
                                            </filter>
                                            </defs>
                                    </svg>
                                </a>                              
                                <a class="action" id="btnCambiarAreaUsuario" href="#" data-bs-toggle="modal" data-bs-target="#modalCambiarAreaUsuario">
                                    <span class="tooltipParent">Cambiar Area <span class="triangulo"></span></span>
                                    <svg width="38" height="34" viewBox="0 0 38 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g filter="url(#filter0_d_2928_43)">
                                        <rect x="4" width="30" height="26" rx="5" fill="white"/>
                                        <path d="M11.1667 16.6247C11.1667 20.0799 13.9615 22.8747 17.4167 22.8747L16.524 21.0893M27.8333 10.3747C27.8333 6.91947 25.0385 4.12467 21.5833 4.12467L22.476 5.91009M10.9469 10.4132C10.2094 10.8122 8.27812 11.6268 9.45417 12.6455C10.0292 13.1434 10.6698 13.4997 11.475 13.4997H16.0677C16.8719 13.4997 17.5125 13.1434 18.0875 12.6455C19.2646 11.6268 17.3323 10.8122 16.5948 10.4132C14.8667 9.4778 12.675 9.4778 10.9469 10.4132ZM16.1146 5.45072C16.1162 5.76005 16.0569 6.06667 15.94 6.35305C15.8231 6.63944 15.6508 6.89998 15.4332 7.11977C15.2155 7.33956 14.9567 7.5143 14.6714 7.634C14.3862 7.75371 14.0802 7.81602 13.7708 7.81738C13.4615 7.81602 13.1555 7.75371 12.8702 7.634C12.585 7.5143 12.3262 7.33956 12.1085 7.11977C11.8908 6.89998 11.7186 6.63944 11.6017 6.35305C11.4848 6.06667 11.4254 5.76005 11.4271 5.45072C11.4253 5.1413 11.4845 4.83457 11.6014 4.54806C11.7182 4.26155 11.8904 4.00089 12.1081 3.78099C12.3258 3.56109 12.5847 3.38625 12.87 3.26649C13.1553 3.14672 13.4614 3.08437 13.7708 3.08301C14.0803 3.08437 14.3864 3.14672 14.6717 3.26649C14.957 3.38625 15.2159 3.56109 15.4335 3.78099C15.6512 4.00089 15.8234 4.26155 15.9403 4.54806C16.0571 4.83457 16.1164 5.1413 16.1146 5.45072ZM22.4052 20.8299C21.6677 21.2288 19.7365 22.0434 20.9125 23.0622C21.4875 23.5601 22.1281 23.9163 22.9333 23.9163H27.526C28.3302 23.9163 28.9708 23.5601 29.5458 23.0622C30.7229 22.0434 28.7906 21.2288 28.0531 20.8299C26.325 19.8945 24.1333 19.8945 22.4052 20.8299ZM27.5729 15.8674C27.5747 16.1768 27.5155 16.4835 27.3986 16.77C27.2818 17.0565 27.1096 17.3172 26.8919 17.5371C26.6742 17.757 26.4153 17.9318 26.13 18.0516C25.8447 18.1714 25.5386 18.2337 25.2292 18.2351C24.9197 18.2337 24.6136 18.1714 24.3283 18.0516C24.043 17.9318 23.7841 17.757 23.5665 17.5371C23.3488 17.3172 23.1766 17.0565 23.0597 16.77C22.9429 16.4835 22.8836 16.1768 22.8854 15.8674C22.8836 15.558 22.9429 15.2512 23.0597 14.9647C23.1766 14.6782 23.3488 14.4176 23.5665 14.1977C23.7841 13.9778 24.043 13.8029 24.3283 13.6832C24.6136 13.5634 24.9197 13.501 25.2292 13.4997C25.5386 13.501 25.8447 13.5634 26.13 13.6832C26.4153 13.8029 26.6742 13.9778 26.8919 14.1977C27.1096 14.4176 27.2818 14.6782 27.3986 14.9647C27.5155 15.2512 27.5747 15.558 27.5729 15.8674Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                        <filter id="filter0_d_2928_43" x="0" y="0" width="38" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feOffset dy="4"/>
                                        <feGaussianBlur stdDeviation="2"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2928_43"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2928_43" result="shape"/>
                                        </filter>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="<?=base_url?>usuario/deshabilitarAreaUsuario?cod=${usuario.codUsuarioArea}" class="action">
                                    <span class="tooltipParent">Deshabilitar <span class="triangulo"></span></span>
                                    <svg width="38" height="34" viewBox="0 0 38 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g filter="url(#filter0_d_2970_8)">
                                        <rect x="4" width="30" height="26" rx="5" fill="white"/>
                                        <path d="M11.0937 18.5859L12.2109 17.4766C10.9877 16.3782 10.0265 15.0193 9.39844 13.5C10.9844 9.53906 15.3594 6.46875 19.5 6.46875C20.5655 6.4831 21.6214 6.67315 22.625 7.03125L23.8359 5.8125C22.4631 5.2319 20.9904 4.92409 19.5 4.90625C16.9535 5.00201 14.4909 5.84184 12.4166 7.32194C10.3422 8.80204 8.747 10.8575 7.82812 13.2344C7.76607 13.406 7.76607 13.594 7.82812 13.7656C8.52207 15.607 9.64096 17.2586 11.0937 18.5859Z" fill="black"/>
                                        <path d="M16.375 13.2891C16.4293 12.5404 16.7513 11.8363 17.2821 11.3055C17.8129 10.7748 18.517 10.4528 19.2656 10.3984L20.6797 8.97656C19.8873 8.76793 19.0541 8.77064 18.2631 8.98442C17.4721 9.19821 16.7509 9.61561 16.1716 10.195C15.5922 10.7744 15.1748 11.4955 14.961 12.2865C14.7472 13.0775 14.7445 13.9108 14.9531 14.7031L16.375 13.2891ZM31.1719 13.2344C30.276 10.9009 28.7172 8.88049 26.6875 7.42188L30.4375 3.66406L29.3359 2.5625L8.5625 23.3359L9.66406 24.4375L13.6484 20.4531C15.425 21.495 17.4407 22.0601 19.5 22.0938C22.0465 21.998 24.5091 21.1582 26.5834 19.6781C28.6578 18.198 30.253 16.1425 31.1719 13.7656C31.2339 13.594 31.2339 13.406 31.1719 13.2344ZM22.625 13.5C22.6217 14.047 22.4749 14.5835 22.1993 15.0559C21.9237 15.5284 21.5289 15.9202 21.0544 16.1922C20.5799 16.4643 20.0423 16.607 19.4953 16.6062C18.9483 16.6054 18.4112 16.461 17.9375 16.1875L22.1875 11.9375C22.4684 12.4107 22.6193 12.9497 22.625 13.5ZM19.5 20.5312C17.861 20.5026 16.253 20.0792 14.8125 19.2969L16.7969 17.3125C17.6995 17.9388 18.7934 18.2281 19.8876 18.1301C20.9818 18.032 22.0068 17.5527 22.7836 16.7758C23.5605 15.999 24.0398 14.974 24.1379 13.8798C24.236 12.7856 23.9466 11.6917 23.3203 10.7891L25.5625 8.54687C27.3551 9.77733 28.757 11.4964 29.6016 13.5C28.0156 17.4609 23.6406 20.5312 19.5 20.5312Z" fill="black"/>
                                        </g>
                                        <defs>
                                        <filter id="filter0_d_2970_8" x="0" y="0" width="38" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feOffset dy="4"/>
                                        <feGaussianBlur stdDeviation="2"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2970_8"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2970_8" result="shape"/>
                                        </filter>
                                        </defs>
                                    </svg>

                                </a>
                            ` : `
                                <a href="<?=base_url?>usuario/habilitarAreaUsuario?cod=${usuario.codUsuarioArea}" class="action">
                                    <span class="tooltipParent">Habilitar <span class="triangulo"></span></span>
                                    <svg width="38" height="34" viewBox="0 0 38 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g filter="url(#filter0_d_2971_18)">
                                        <rect x="4" width="30" height="26" rx="5" fill="white"/>
                                        <path d="M28.544 12.045C28.848 12.471 29 12.685 29 13C29 13.316 28.848 13.529 28.544 13.955C27.178 15.871 23.689 20 19 20C14.31 20 10.822 15.87 9.456 13.955C9.152 13.529 9 13.315 9 13C9 12.684 9.152 12.471 9.456 12.045C10.822 10.129 14.311 6 19 6C23.69 6 27.178 10.13 28.544 12.045Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M22 13C22 12.2044 21.6839 11.4413 21.1213 10.8787C20.5587 10.3161 19.7956 10 19 10C18.2044 10 17.4413 10.3161 16.8787 10.8787C16.3161 11.4413 16 12.2044 16 13C16 13.7956 16.3161 14.5587 16.8787 15.1213C17.4413 15.6839 18.2044 16 19 16C19.7956 16 20.5587 15.6839 21.1213 15.1213C21.6839 14.5587 22 13.7956 22 13Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                        <filter id="filter0_d_2971_18" x="0" y="0" width="38" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feOffset dy="4"/>
                                        <feGaussianBlur stdDeviation="2"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2971_18"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2971_18" result="shape"/>
                                        </filter>
                                        </defs>
                                    </svg>

                                </a>
                            `}
                        </td>
                    </tr>
                    `
                    ).join('');
                    // Actualizar el contenido del select
                    $('#bodyListaUsuarios').html(row);
                } else {
                    console.warn('No data received or data is not an array.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    loadUsuarios();

    // nuevo
    $(document).on("click", "#btnRegistrarUsuario", function(e){
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarUsuario");
        $("#registrarUsuarioForm").trigger("reset");
        modalRegistrar.modal('show');

        modalRegistrar.on('shown.bs.modal', function () {
            $("#nombresNuevo").focus();
        });
    });


    $('#registrarUsuarioForm').submit( function (e) {
        e.preventDefault();

        let nombre = $.trim($('#nombresNuevo').val());
        let apellidos = $.trim($('#apellidosNuevo').val());
        let telefono = $.trim($('#telefonoNuevo').val());
        let dni = $.trim($('#dniNuevo').val());
        let usuario = $.trim($('#usuarioNuevo').val());
        let rol = $.trim($('#selectRol').val());
        let area = $.trim($('#selectAreas').val());
        let password = $.trim($('#passwordNuevo').val());
        let confirm_password = $.trim($('#passwordConfirmarNuevo').val());


        if (password != confirm_password){
            Swal.fire({
                icon: "warning",
                title: "Las contraseñas no coninciden",
                text: "Asegurese de ingresar contraseñas que coincidan",
            });
            return
        }

        if(nombre.length == 0 || apellidos.length == 0 || telefono.length == 0 || dni.length == 0
            || usuario.length == 0 || rol.length == 0 || area.length == 0 || password.length == 0 || confirm_password.length == 0){
            Swal.fire({
                icon: "warning",
                title: "Campos Incompletos",
                text: "Ingrese los campos requeridos",
            });
            return;
        }

        if (dni.length < 8 || dni.length > 8){
            Swal.fire({
                icon: "warning",
                title: "Campos Incorrectos",
                text: "Ingrese un DNI valido",
            });
            return;
        }

        if (telefono.length < 9 || telefono.length > 9){
            Swal.fire({
                icon: "warning",
                title: "Campos Incorrectos",
                text: "Ingrese un télefono valido",
            });
            return;
        }

        nombre = capitalizeWords(nombre);
        apellidos = capitalizeWords(apellidos);

        $.ajax({
            url: "./controllers/usuario/registrarUsuario.php",
            type: "POST",
            dataType: "json",
            data: {nombre, apellidos, telefono, dni, usuario, rol, area, password},
            success: function (response) {
                if (response.message == '¡Usuario encontrado!'){
                    Swal.fire({
                        icon: "warning",
                        title: "¡Advertencia!",
                        text: "El usuario que intenta registrar ya se encuentra registrado"
                    })
                }else{
                    if (response.status == 'success'){
                        Swal.fire({
                            icon: "success",
                            title: "Registro Exitoso",
                            text: "Se registro correctamente el usuario"
                        }).then(() => {
                            $('#modalRegistrarUsuario').modal('hide');
                            loadUsuarios();
                        })
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Ocurrio un error al momento de registrar el usuario" + response.message
                        })
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        })
    } )

    // editar
    $(document).on("click", "#btnEditarUsuario", function(e){
        e.preventDefault();
        let modalActualizar = $("#modalEditarUsuario");
        let fila = $(this).closest("tr");
        let codPersona = fila.find('td:eq(2)').text();
        let rol = fila.find('td:eq(3)').text();
        let usuario = fila.find('td:eq(4)').text();
        let nombres = fila.find('td:eq(6)').text();
        let apellidos = fila.find('td:eq(7)').text();
        let dni = fila.find('td:eq(8)').text();
        let telefono = fila.find('td:eq(9)').text();
        $("#codPersona").val(codPersona.trim());
        $("#nombresEditar").val(nombres.trim());
        $("#apellidosEditar").val(apellidos.trim());
        $("#telefonoEditar").val(apellidos.trim());
        $("#dniEditar").val(dni.trim());
        $("#telefonoEditar").val(telefono.trim());
        $("#usuarioEditar").val(usuario.trim());
        $(".selectRol").val(rol);

        modalActualizar.modal('show');

        modalActualizar.on('shown.bs.modal', function () {
            $("#nombresEditar").focus();
        });

    });

    // actualizar
    $('#editarUsuarioForm').submit(function(e){
        e.preventDefault();

        let codPersona = $.trim($('#codPersona').val());
        let nombre = $.trim($('#nombresEditar').val());
        let apellidos = $.trim($('#apellidosEditar').val());
        let telefono = $.trim($('#telefonoEditar').val());
        let dni = $.trim($('#dniEditar').val());
        let usuario = $.trim($('#usuarioEditar').val());
        let rol = $.trim($('#selectRolEditar').val());

        console.log({nombre, apellidos, telefono, dni, usuario, rol})

        if(codPersona.length == 0 || nombre.length == 0 || apellidos.length == 0 || telefono.length == 0 ||
            dni.length == 0 || usuario.length == 0 || rol.length == 0){
            Swal.fire({
                icon: "warning",
                title: "Campos Incompletos",
                text: "Ingrese los campos requeridos",
            });
            return;
        }

        if (dni.length < 8 || dni.length > 8){
            Swal.fire({
                icon: "warning",
                title: "Campos Incorrectos",
                text: "Ingrese un DNI valido",
            });
            return;
        }

        if (telefono.length < 9 || telefono.length > 9){
            Swal.fire({
                icon: "warning",
                title: "Campos Incorrectos",
                text: "Ingrese un télefono valido",
            });
            return;
        }

        nombre = capitalizeWords(nombre);
        apellidos = capitalizeWords(apellidos);

        $.ajax({
            url: "./controllers/usuario/actualizarUsuario.php",
            type: "POST",
            datatype: "json",
            data: {codPersona, nombre, apellidos, telefono, dni, usuario, rol},
            success: function(response) {
                console.log(response)
                response = JSON.parse(response);
                if (response.status == 'success'){
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: response.message
                    }).then(() => {
                        $('#modalEditarUsuario').modal('hide');
                        loadUsuarios();
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error updating the area:', textStatus, errorThrown);
            }
        });
    });

    let codAreaActual = 0;
    // muestra el modal para cambiar el area a un usuario
    $(document).on("click", "#btnCambiarAreaUsuario", function(e){
        e.preventDefault();
        let modalActualizar = $("#modalCambiarAreaUsuario");
        let fila = $(this).closest("tr");
        let codUsuarioArea = fila.find('td:eq(0)').text();
        let codUsuario = fila.find('td:eq(1)').text();
        let codArea = fila.find('td:eq(11)').text();
        codAreaActual = codArea;
        $("#codUsuarioArea").val(codUsuarioArea.trim());
        $("#codUsuario").val(codUsuario.trim());
        $(".selectArea").val(codArea.trim());

        modalActualizar.modal('show');
    });

    // registrar nueva area para el usuario
    $('#cambiarAreaUsuarioForm').submit(function(e){
        e.preventDefault();
        let codUsuarioArea = $.trim($('#codUsuarioArea').val());
        let codUsuario = $.trim($('#codUsuario').val());
        let codAreaNueva = $.trim($('#selectAreaCambiar').val());

        console.log('actual ', codAreaActual);
        console.log('nueva ',codAreaNueva);
        if (codAreaActual == codAreaNueva){
            Swal.fire({
                icon: "warning",
                title: "Campos Iguales",
                text: "Para cambiar de área al usuario debe seleccionar una nueva área",
            });
            return;
        }

        $.ajax({
            url: "./controllers/usuario/cambiarAreaUsuario.php",
            type: "POST",
            datatype: "json",
            data: {codUsuarioArea, codUsuario, codAreaNueva},
            success: function(response) {
                console.log(response)
                response = JSON.parse(response);
                if (response.status == 'success'){
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: response.message
                    }).then(() => {
                        $('#modalCambiarAreaUsuario').modal('hide');
                        loadUsuarios();
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error updating the area:', textStatus, errorThrown);
            }
        });
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

    // Generar usuario
    const nombreInput = $('#nombresEditar');
    const apellidoInput = $('#apellidosEditar');
    const usuarioInput = $('#usuarioEditar');

    function generarUsuario() {
        const nombre = nombreInput.val().trim();
        const apellidos = apellidoInput.val().trim().split(' ');

        if (nombre && apellidos.length >= 2) {
            const primerNombreLetra = nombre.charAt(0).toLowerCase();
            const primerApellido = apellidos[0].toLowerCase();
            const segundoApellidoLetra = apellidos[1].charAt(0).toLowerCase();

            usuarioInput.val(primerNombreLetra + primerApellido + segundoApellidoLetra);
        } else {
            usuarioInput.val('');
        }
    }

    nombreInput.on('input', generarUsuario);
    apellidoInput.on('input', generarUsuario);

});