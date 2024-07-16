<?php
    switch ($_SESSION['response']['action']) {
        case "buscar":
        case "registrar":
            $ruta = 'crear';
            break;
        case "actualizar":
            $ruta = 'listar';
            break;
        default:
            $ruta = "listar";
            break;
}
?>

<div class="containerMensajeRegistro">
    <div class="header">
        <?php if($_SESSION['response']['status'] == 'success'): ?>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.<path fill="#41a914" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
        <?php elseif($_SESSION['response']['status'] == 'not found' || $_SESSION['response']['status'] == 'warning'): ?>
            <svg xmlns="http://www.w3.org/2000/svg" fill="orange" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
        <?php else: ?>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#eb0000" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>
        <?php endif; ?>
    </div>
    <div class="body">
            <p class="mensaje"> <?= $_SESSION['response']['message'] ?></p>
            <?php if ($_SESSION['response']['action'] == 'login'): ?>
                <a href="<?=base_url?>">Aceptar</a>
            <?php else: ?>
                <a href="<?=base_url?><?=$_SESSION['response']['module']?>/<?=$ruta?>">Regresar</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php //var_dump($_SESSION['response']['info']); ?>
