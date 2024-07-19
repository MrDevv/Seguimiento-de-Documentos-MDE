<?php
if (!isset($_SESSION)){
    session_start();
}
?>

<div class="inicio">
    <h1>Bienvenido(a), <?= $_SESSION['user']['nombres']?></h1>
    <p>Has ingresado al sistema de seguimiento de documentos internos y externos</p>
</div>