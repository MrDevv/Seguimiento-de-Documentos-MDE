
async function modalConfirmarRecepcion(idDocumento) {

    try {
        const baseUrl = "http://localhost/Seguimiento-de-Documentos-MDE/";
        const response = await fetch(`${baseUrl}views/documentos/modals/confirmarRecepcion.php`);

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

function validarCampos({...obj}) {
    console.log("tipoDocumento")
}

async function mostrarModalCamposIncompletos() {
    try {
        const baseUrl = "http://localhost/Seguimiento-de-Documentos-MDE/";
        const response = await fetch(`${baseUrl}views/modals/alertaCamposIncompletos.php`);

        if (!response.ok) {
            throw new Error("Error al cargar la modal");
        }


        const data = await response.text();

        const modalContainer = document.createElement("div");
        modalContainer.classList.add("modal-container")
        modalContainer.innerHTML = data;

        document.body.appendChild(modalContainer);

    }catch (e) {
        console.log(e)
    }
}

function cerrar() {
    console.log("ccerrando modal")
    let modalHTML = document.querySelector(".modal-container")

    if (modalHTML){
        document.body.removeChild(modalHTML);

        let currentUrl = new URL(window.location.href);
        currentUrl.searchParams.delete("documento");
        window.history.replaceState({}, '', currentUrl);
    }
}