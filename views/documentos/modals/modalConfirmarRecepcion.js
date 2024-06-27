
async function modalConfirmarRecepcion() {

    try {
        const baseUrl = "http://localhost/Seguimiento-de-Documentos-MDE/";
        const response = await fetch(`${baseUrl}views/documentos/modals/confirmarRecepcion.php`);

        //const response = await fetch("views/documentos/modals/confirmarRecepcion.php")

        if (!response.ok) {
            throw new Error("Error al cargar la modal");
        }

        console.log(response)


        const data = await response.text();

        const modalContainer = document.createElement("div");
        modalContainer.classList.add("modal-container")
        modalContainer.innerHTML = data;

        document.body.appendChild(modalContainer);

        console.log(data)
    }catch (e) {
        console.log(e)
    }

}