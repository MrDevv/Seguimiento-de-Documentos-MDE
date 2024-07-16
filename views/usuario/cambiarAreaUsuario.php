<div class="containerCambiarAreaUsuario">
    <div class="column">
        <h2>Cambiar Area de Usuario</h2><br>
        <form action="<?=base_url?>usuario/actualizarAreaUsuario" method="post">
            <div>
                <input type="text" readonly value="<?=$codUsuarioArea ?>"  name="codUsuarioArea" hidden="hidden">
                <input type="text" readonly value="<?=$codUsuario ?>"  name="codUsuario" hidden="hidden">
                <label for="area">Cambiar Area:</label>
                    <select id="area" name="area" required>
                    <?php foreach ($areas as $result):?>
                    <option 
                        value="<?=$result['codArea']?>"
                        >
                    <?=$result['descripcion']?>
                    </option>
                                
                    <?php endforeach; ?>
                    </select>
            </div>
            <div class="btnCambiarAreaUsuario">
                <input type="submit" value="Cambiar">
                <a href="<?=base_url?>usuario/listar">Regresar</a>
            </div>
        </form>

    </div>

</div>
