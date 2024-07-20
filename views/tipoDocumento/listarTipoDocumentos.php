
<div class="containerPendientesRecepcion">
    <div class="pendientesRecepcion_header">
        <h2>Bandeja de Entrada</h2>
        <p>Listado de los Tipos de Documentos</p>
    </div>
    <div class="pendientesRecepcion_body">
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Tipo Documento</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($listadoTipoDocumentos as $result):?>
<!--            --><?php //var_dump($result); ?>
                <tr>
                    <td> <?=$result["codTipoDocumento"]?> </td>
                    <td> <?=$result["descripcion"]?> </td>
                    <td class="actions">
                        <a class="action" href="<?=base_url?>tipoDocumento/editar?doc=<?=$result["codTipoDocumento"]?>">
                            <span class="tooltipParent">Editar <span class="triangulo"></span></span>
                            <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>