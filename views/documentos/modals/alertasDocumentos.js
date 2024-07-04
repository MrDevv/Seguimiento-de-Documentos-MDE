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
    }catch (e) {
        console.log(e)
    }
}

async function modalFinalizarSeguimientoDocumento(idDocumento) {
    try {
        const baseUrl = "http://localhost/Seguimiento-de-Documentos-MDE/";
        const response = await fetch(`${baseUrl}views/documentos/modals/alertaFinalizarSeguimientoDocumento.php`);

        if (!response.ok) {
            throw new Error("Error al cargar la modal");
        }

        const data = await response.text();

        const modalContainer = document.createElement("div");
        modalContainer.classList.add("modal-container")
        modalContainer.innerHTML = data;

        document.body.appendChild(modalContainer);

        let codigo = document.querySelector("#codDocumento");

        console.log(codigo)

        codigo.value = idDocumento

        // console.log(data)
    }catch (e) {
        console.log(e)
    }
}

async function modalReanudarSeguimientoDocumento(idDocumento) {
    try {
        const baseUrl = "http://localhost/Seguimiento-de-Documentos-MDE/";
        const response = await fetch(`${baseUrl}views/documentos/modals/alertaReanudarSeguimientoDocumento.php`);

        if (!response.ok) {
            throw new Error("Error al cargar la modal");
        }

        const data = await response.text();

        const modalContainer = document.createElement("div");
        modalContainer.classList.add("modal-container")
        modalContainer.innerHTML = data;

        document.body.appendChild(modalContainer);

        let codigo = document.querySelector("#codDocumento");

        console.log(codigo)

        codigo.value = idDocumento

        // console.log(data)
    }catch (e) {
        console.log(e)
    }
}

function cerrar() {
    let modalHTML = document.querySelector(".modal-container")

    if (modalHTML){
        document.body.removeChild(modalHTML);
    }
}