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

</div>
<?php  require_once "registro.php"?>
<?php  require_once "editarUsuario.php"?>

<script src="<?= base_url?>ajax/listarUsuario.js"></script>
