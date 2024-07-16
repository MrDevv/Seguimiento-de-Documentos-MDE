<?php
require_once('models/Estado.php');
$estado = new Estado();
$estados= $estado->listarEstadosHabilitadoInhabilitado();
?>
<div class="containerRegistroUsuario">
    <h2>Editar Usuario</h2>
    <div class="body">
        <form action="<?=base_url?>usuario/actualizarUsuario" method="post">
            <div class="data">
                <div class="column">
                    <h3>Datos Generales</h3><br>
                    <div class="row">
                    <input 
                                    type="text"
                                    id="codPersona"
                                    name="codPersona"
                                    value="<?=$responsePersona[0]['codPersona'] ?>" 
                                    required
                                    hidden
                            >
                        <div>
                            <label for="nombre">Nombre:</label>
                            <input 
                                    type="text"
                                    id="nombre"
                                    name="nombre"
                                    value="<?=$responsePersona[0]['nombres'] ?>" 
                                    required
                            >
                        </div> 
                        <div>
                                <label for="apellidos">Apellidos:</label>
                                <input 
                                    type="text" 
                                    id="apellido" 
                                    name="apellidos"
                                    value="<?=$responsePersona[0]['apellidos'] ?>" 
                                    required
                                >
                        </div>
                    </div>
                    <div class="row">
                        <div>
                                <label for="telefono">Teléfono:</label>
                                <input type="text" name="telefono" maxlength="9" value="<?=$responsePersona[0]['telefono'] ?>"  required>
                        </div>
                        <div>
                            <label for="dni">DNI:</label>
                            <input type="text" name="dni" maxlength="8" value="<?=$responsePersona[0]['dni'] ?>"  required >
                        </div>

                    </div>

                    <h3>Datos de Usuario</h3><br>
                    <div class="row">
                    <input 
                                    type="text"
                                    id="codUsuario"
                                    name="codUsuario"
                                    value="<?=$responseUsuario[0]['codUsuario'] ?>"
                                    hidden
                                    required
                            >
                        <div>
                            <label for="usuario">Usuario:</label>
                            <input
                                class="disabled" 
                                type="text" 
                                id="usuario" 
                                name="usuario"
                                value="<?=$responseUsuario[0]['nombreUsuario'] ?>" 
                                readonly 
                                required>
                        </div>
                        <div>
                            <label for="contrasena">Nueva Contraseña:</label>
                            <input 
                                type="password" 
                                id="new_password" 
                                name="new_password" 
                                class="user-input"
                                value="<?=$responseUsuario[0]['password'] ?>"  
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                                <label for="rol">Rol:</label>
                                <select id="rol" name="rol" required>
                                    <?php foreach ($roles as $result):?>
                                    <option 
                                    value="<?=$result['codRol']?>"
                                    <?=$responseUsuario[0]['codRol'] == $result['codRol'] ? 'selected' : ''?>
                                    >
                                    <?=$result['descripcion']?>
                                </option>
                                    
                                    <?php endforeach; ?>
                                </select>
                        </div>
                        <div>
                            <label for="contrasena">Confirmar Contraseña:</label>
                            <input 
                                type="password" 
                                id="confirm_password" 
                                name="confirm_password" 
                                value="<?=$responseUsuario[0]['password'] ?>"  
                                class="user-input" 
                                required>
                        </div>
                    </div>
                </div>
            </div>    
 
           

            <input type="submit" value="Actualizar">
        </form>

    </div>
        
    </div>