<?php
function mostrarAlerta($titulo, $mensaje, $icono, $redireccion = '') {
    echo '<script type="text/javascript">';
    echo 'Swal.fire({
            title: "' . $titulo . '",
            text: "' . $mensaje . '",
            icon: "' . $icono . '",
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {';

    if (!empty($redireccion)) {
        echo 'window.location.href = "' . $redireccion . '";';
    }

    echo '}
        });';
    echo '</script>';
}
?>
