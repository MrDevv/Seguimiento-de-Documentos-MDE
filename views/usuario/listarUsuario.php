<?php
require_once('../../config/parameters.php');
require_once('../../config/DataBase.php');
require_once('../../models/Estado.php');
?>

<div class="containerListadoUsuarios">
    <div class="listadoUsuarios_header">
        <div>
            <h2>Bandeja de Entrada</h2>
            <p>Listado de Usuarios</p>
            <div class="filtros">
                <div>
                    <p>Apellidos: </p>
                    <input type="text" id="filtroUsuarioApellidos" autocomplete="off">
                </div>
                <div>
                    <p>Estado:</p>
                    <select class="form-select selectEstado">
                        <option value="0">Todos</option>
                        <option value="1" selected>Activos</option>
                        <option value="2">Inactivos</option>
                    </select>
                </div>
            </div>
        </div>
        <a href="#" id="btnRegistrarUsuario" class="btnNuevoRegistro">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
            Nuevo Usuario
        </a>
    </div>
    <div class="listadoUsuarios_body">
        <table>
            <thead>
            <tr>
                <th>CodUsuario</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Telefono</th>
                <th>Area</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="bodyListaUsuarios">
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between m-2">
        <div>
            <p class="fs-6">Total de usuarios:  <span class="fw-bold" id="totalUsuariosRegistrados"></span></p>
        </div>
        <div>
            <ul class="listadoOpcionesPaginacion" id="opcionesPaginacionUsuarios">

            </ul>
        </div>
    </div>

</div>
<?php  require_once "registro.php"?>
<?php  require_once "editarUsuario.php"?>
<?php  require_once "cambiarAreaUsuario.php"?>
<?php  require_once "cambiarPasswordUsuario.php"?>

<script src="<?= base_url?>ajax/listarUsuario.js"></script>
