<?php
require_once('models/Estado.php');
$estado = new Estado();
$estados= $estado->listarEstadosHabilitadoInhabilitado();
?>
<div class="containerRegistroUsuario">
    <h2>Editar Usuario</h2>
    <div class="body">
        <form action="<?=base_url?>usuario/actualizar" method="post">
            <h3>Datos Generales</h3><br>
            <div class="row">
                <div>
                    <label for="nombre">Nombre:</label>
                    <input 
                            type="text"
                            name="nombre"
                            required
                    >
                </div> 
                <div>
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos">
                </div>
            </div>
            <div class="row">
                <div>
                        <label for="telefono">Teléfono:</label>
                        <input type="number" id="telefono" name="telefono">
                </div>
                <div>
                    <label for="telefono">DNI:</label>
                    <input type="text" id="dni" name="tdni">
                </div>

            </div>
            

            <h3>Datos de Usuario</h3><br>
            <div class="row">
                <div>
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" value="restradal" disabled>
                </div>
                <div>
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" class="user-input">
                </div>
            </div>
            <div class="row">
                <div>
                        <label for="contrasena">Rol:</label>
                        <select id="rol" name="rol">
                                    <?php foreach ($roles as $result):?>
                                    <option 
                                    value="<?=$result['codRol']?>"
                                    >
                                    <?=$result['descripcion']?>
                                </option>
                                    
                                    <?php endforeach; ?>
                        </select>
                </div>
            </div>
            
            <input type="submit" value="Actualizar">
        </form>

    </div>
        
    </div>