<?php
require_once('../../config/parameters.php');
require_once('../../config/DataBase.php');
require_once('../../models/Estado.php');
?>

<div class="containerPendientesRecepcion">
    <div class="pendientesRecepcion_header">
        <h2>Bandeja de Entrada</h2>
        <p>Listado de Usuarios</p>
    </div>
    <div class="pendientesRecepcion_body">
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

    <script src="<?= base_url?>ajax/listarUsuario.js"></script>
</div>