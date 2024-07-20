$(document).ready(function() {
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
                        <td>${usuario.usuario}</td>
                        <td>${usuario.rol}</td>
                        <td>${usuario.nombres}</td>
                        <td>${usuario.apellidos}</td>
                        <td>${usuario.dni}</td>
                        <td>${usuario.telefono}</td>
                        <td>${usuario.area}</td>
                        <td>
                            <span class="estado ${usuario.estado === 'a' ? 'active' : 'inactive'}">
                                ${usuario.estado === 'a' ? 'Activo' : 'Inactivo'}
                            </span>
                        </td>
                        <td class="actions">
                            ${usuario.estado === 'a' ? `
                                <a class="action" href="<?=base_url?>usuario/editar?cod=${usuario.codUsuario}">
                                    <span class="tooltipParent">Editar <span class="triangulo"></span></span>
                                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <!--! Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free -->
                                        <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                                    </svg>
                                </a>
                                <a class="action" href="<?=base_url?>usuario/cambiarAreaUsuario?cod=${usuario.codUsuarioArea}&user=${usuario.codUsuario}">
                                    <span class="tooltip">Cambiar Area <span class="triangulo"></span></span>
                                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M3.789 9.037c-.708.383-2.562 1.165-1.433 2.143c.552.478 1.167.82 1.94.82h4.409c.772 0 1.387-.342 1.939-.82c1.13-.978-.725-1.76-1.433-2.143c-1.659-.898-3.763-.898-5.422 0M8.75 4.273A2.26 2.26 0 0 1 6.5 6.545a2.26 2.26 0 0 1-2.25-2.272A2.26 2.26 0 0 1 6.5 2a2.26 2.26 0 0 1 2.25 2.273M4 15c0 3.317 2.683 6 6 6l-.857-1.714M20 9c0-3.317-2.683-6-6-6l.857 1.714m-.068 14.323c-.708.383-2.562 1.165-1.433 2.143c.552.478 1.167.82 1.94.82h4.409c.772 0 1.387-.342 1.939-.82c1.13-.978-.725-1.76-1.433-2.143c-1.659-.898-3.763-.898-5.422 0m4.961-4.764a2.26 2.26 0 0 1-2.25 2.273a2.26 2.26 0 0 1-2.25-2.273A2.26 2.26 0 0 1 17.5 12a2.26 2.26 0 0 1 2.25 2.273"
                                              color="black"/>
                                    </svg>
                                </a>
                                <a href="<?=base_url?>usuario/deshabilitarAreaUsuario?cod=${usuario.codUsuarioArea}" class="action">
                                    <span class="tooltip">Deshabilitar <span class="triangulo"></span></span>
                                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                        <path fill="black" d="m5.24 22.51l1.43-1.42A14.06 14.06 0 0 1 3.07 16C5.1 10.93 10.7 7 16 7a12.4 12.4 0 0 1 4 .72l1.55-1.56A14.7 14.7 0 0 0 16 5A16.69 16.69 0 0 0 1.06 15.66a1 1 0 0 0 0 .68a16 16 0 0 0 4.18 6.17"/>
                                        <path fill="black" d="M12 15.73a4 4 0 0 1 3.7-3.7l1.81-1.82a6 6 0 0 0-7.33 7.33zm18.94-.07a16.4 16.4 0 0 0-5.74-7.44L30 3.41L28.59 2L2 28.59L3.41 30l5.1-5.1A15.3 15.3 0 0 0 16 27a16.69 16.69 0 0 0 14.94-10.66a1 1 0 0 0 0-.68M20 16a4 4 0 0 1-6 3.44L19.44 14a4 4 0 0 1 .56 2m-4 9a13.05 13.05 0 0 1-6-1.58l2.54-2.54a6 6 0 0 0 8.35-8.35l2.87-2.87A14.54 14.54 0 0 1 28.93 16C26.9 21.07 21.3 25 16 25"/>
                                    </svg>
                                </a>
                            ` : `
                                <a href="<?=base_url?>usuario/habilitarAreaUsuario?cod=${usuario.codUsuarioArea}" class="action">
                                    <span class="tooltip">Habilitar <span class="triangulo"></span></span>
                                    <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <g fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="black">
                                            <path d="M21.544 11.045c.304.426.456.64.456.955c0 .316-.152.529-.456.955C20.178 14.871 16.689 19 12 19c-4.69 0-8.178-4.13-9.544-6.045C2.152 12.529 2 12.315 2 12c0-.316.152-.529.456-.955C3.822 9.129 7.311 5 12 5c4.69 0 8.178 4.13 9.544 6.045"/>
                                            <path d="M15 12a3 3 0 1 0-6 0a3 3 0 0 0 6 0"/>
                                        </g>
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
});