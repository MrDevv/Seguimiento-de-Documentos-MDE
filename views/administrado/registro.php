<?php
require_once('models/Estado.php');
$estado = new EstadoController();
$estados= $estado->listarEstadosHabilitadoInhabilitado();
?>
<div class="container-registro-administrado">
    <h2>Registrar Administrado</h2>
        <form>
            <div class="section">
                <h3>Datos Generales</h3>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input 
                    type="text" id="nombre" 
                    name="nombre"><br>
                </div>

                <div class="form-group">
                    <label for="area">Área:</label>
                        <select id="area" name="area">
                        <?php foreach ($areas as $result):?>
                            <option 
                                value="<?=$result['codArea']?>"
                            >
                            <?=$result['descripcion']?>
                            </option>
                            <?php endforeach; ?>
                                <!-- Agrega más opciones según sea necesario -->
                        </select><br>
                </div>
                
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos"><br>
                </div>

                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado">
                        <?php foreach ($estados as $result):?>
                        <option 
                        value="<?=$result['codEstado']?>"
                        >
                        <?=$result['descripcion']?>
                    </option><br>
                        
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono"><br>
                </div>
            </div>

            <div class="section">
                <h3>Datos de Usuario</h3>
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" value="restradal" disabled><br>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" class="user-input"><br>
                </div>
            </div>
            
            <div class="button-container">
                <button type="submit">Registrar</button>
            </div>
        </form>
    </div>