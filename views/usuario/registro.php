<?php
require_once('models/Estado.php');
$estado = new Estado();
$estados= $estado->listarEstadosHabilitadoInhabilitado();
?>
<div class="containerRegistroDocumento">
    <h2>Registro de Personas</h2>
    <div class="body">
        <form action="<?=base_url?>usuario/registrar" method="post">
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
            <div class="row">
                <div>
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado">
                        <?php foreach ($estados as $result):?>
                        <option 
                        value="<?=$result['codEstado']?>"
                        >
                        <?=$result['descripcion']?>
                    </option>
                        
                        <?php endforeach; ?>
                    </select>
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
                        <input type="text" id="rol" name="rol">
                </div>
                <div>
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado">
                        <?php foreach ($estados as $result):?>
                        <option 
                        value="<?=$result['codEstado']?>"
                        >
                        <?=$result['descripcion']?>
                    </option>
                        
                        <?php endforeach; ?>
                    </select>
                </div>


            </div>
            
            <input type="submit" value="Registrar">
        </form>

    </div>
        
    </div>