<?php
require_once('../../config/parameters.php');
require_once('../../config/DataBase.php');
require_once('../../models/Estado.php');
$estado = new Estado();
$estados= $estado->listarEstadosHabilitadoInhabilitado();
?>

<div class="containerRegistroUsuario">
    <h2>Registro de Usuario</h2>
    <div class="body">
        <form action="" id="registrarUsuarioForm" method="post">
            <div class="data">
                <div class="column">
                    <h3>Datos Generales</h3><br>
                    <div class="row">
                        <div>
                            <label for="nombre">Nombre:</label>
                            <input 
                                    type="text"
                                    id="nombre"
                                    name="nombre"
                            >
                        </div> 
                        <div>
                                <label for="apellidos">Apellidos:</label>
                                <input
                                        type="text"
                                        id="apellido"
                                        name="apellidos"
                                >
                        </div>
                    </div>
                    <div class="row">
                        <div>
                                <label for="telefono">Teléfono:</label>
                                <input type="text" name="telefono" maxlength="9" required>
                        </div>
                        <div>
                            <label for="dni">DNI:</label>
                            <input type="text" name="dni" maxlength="8" required >
                        </div>

                    </div>

                    <h3>Datos de Usuario</h3><br>
                    <div class="row">
                        <div>
                            <label for="usuario">Usuario:</label>
                            <input 
                                class="disabled"
                                type="text" 
                                id="usuario" 
                                name="usuario" 
                                readonly required
                            >
                        </div>
                        <div>
                            <label for="contrasena">Contraseña:</label>
                            <input type="password" id="password" name="password" class="user-input" required>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                                <label for="rol">Rol:</label>
                                <select id="selectRol" name="rol" required>
                                </option>
                                </select>
                        </div>
                        <div>
                            <label for="contrasena">Confirmar Contraseña:</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="user-input" required>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <h3>Dato Area</h3>
                    <br>
                    <div>
                        <label for="area">Area:</label>
                        <select id="selectAreas" name="area" required>
                        </select>
                    </div>
                </div>
            </div>    
 
           

            <input type="submit" value="Registrar">
        </form>

    </div>
        
    </div>

<script src="<?=base_url?>helpers/generarUserName.js"></script>
<script src="<?= base_url?>ajax/listarRoles.js"></script>
<script src="<?= base_url?>ajax/listarAreas.js"></script>
<script src="<?= base_url?>ajax/registrarUsuario.js"></script>
