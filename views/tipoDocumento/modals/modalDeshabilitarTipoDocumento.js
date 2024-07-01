
async function modalDeshabilitarTipoDocumento(idDocumento) {

    try {
        const baseUrl = "http://localhost/Seguimiento-de-Documentos-MDE/";
        const response = await fetch(`${baseUrl}views/tipoDocumento/modals/alertDeshabilitar.php`);

        if (!response.ok) {
            throw new Error("Error al cargar la modal");
        }


        const data = await response.text();

        const modalContainer = document.createElement("div");
        modalContainer.classList.add("modal-container")
        modalContainer.innerHTML = data;

        document.body.appendChild(modalContainer);

        let currentUrl = new URL(window.location.href);

// Paso 2: Agregar el parámetro deseado
        currentUrl.searchParams.set('documento', idDocumento);

// Paso 3: Actualizar la URL del navegador
        window.history.replaceState({}, '', currentUrl);

        // console.log(data)
    }catch (e) {
        console.log(e)
    }

}
