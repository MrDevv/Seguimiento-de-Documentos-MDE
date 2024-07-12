<div class="containerCambiarAreaUsuario">
    <div class="column">
        <h2>Cambiar Area de Usuario</h2><br>
        <form action="<?=base_url?>usuario/actualizarAreaUsuario" method="post">
            <div>
                <input type="text" readonly value="<?=$codUsuario ?>" hidden name="codUsuario">
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
            <input type="submit" value="Cambiar">
            <a href="<?=base_url?>usuario/listar">Regresar</a>
        </form>

    </div>

</div>
