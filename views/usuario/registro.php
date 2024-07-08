<?php
require_once('models/Estado.php');
$estado = new Estado();
$estados= $estado->listarEstadosHabilitadoInhabilitado();
?>
<div class="containerRegistroUsuario">
    <h2>Registro de Personas</h2>
    <div class="body">
        <form action="<?=base_url?>usuario/registrar" method="post">
            <div class="data">
                <div class="column">
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
                                <label for="rol">Rol:</label>
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
                </div>

                <div class="column">
                    <h3>Dato Area</h3>
                    <br>
                    <div>
                        <label for="area">Area:</label>
                        <select id="area" name="area">
                            <?php foreach ($areas as $result):?>
                            <option 
                            value="<?=$result['codArea']?>"
                            >
                            <?=$result['descripcion']?>
                        </option>
                            
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>    
 
           

            <input type="submit" value="Registrar">
        </form>

    </div>
        
    </div>