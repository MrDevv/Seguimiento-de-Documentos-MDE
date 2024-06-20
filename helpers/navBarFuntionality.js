
/*
let optionAdministrados = document.querySelector("#optionAdministrados");
let containerSubMenu = document.querySelector("#submenuAdministrados");

let svgOption = document.querySelector("#svgOption");
let containerOptionsAdministrados = document.querySelector("#options-administrados");

optionAdministrados.addEventListener('click', () => {
    optionAdministrados.classList.toggle("selected");
    containerSubMenu.classList.toggle('showOptions');
    containerOptionsAdministrados.classList.toggle("openPaddingOptions");
    svgOption.classList.toggle("open");
});

*/
document.addEventListener('DOMContentLoaded', function() {
    let optionsNavBar = document.querySelectorAll(".option");
    let optionActive = ""

    optionsNavBar.forEach(function(opcion) {
        opcion.addEventListener('click', function() {
            if (opcion != optionActive){
                deleteClass();
            }
            optionActive = opcion;


            let option = document.querySelector( "#"+opcion.id);

            if (option.id != "optionInicio"){
                let containerSubmenu = document.querySelector("#"+option.parentElement.lastElementChild.id);
                let svgOption = document.querySelector("#"+option.lastElementChild.lastElementChild.id);
                let containerOptions = document.querySelector("#"+option.parentElement.lastElementChild.firstElementChild.id);

                console.log(svgOption)
                containerSubmenu.classList.toggle('showOptions');
                containerOptions.classList.toggle("openPaddingOptions");
                svgOption.classList.toggle("open");
            }

            option.classList.toggle("selected");
        });
    });


    function deleteClass() {
        optionsNavBar.forEach(function(opcion) {
            let option = document.querySelector( "#"+opcion.id);

            let containerSubmenu = document.querySelector("#"+option.parentElement.lastElementChild.id);



           // let containerOptions = document.querySelector("#"+option.parentElement.lastElementChild.firstElementChild.id);

            if (option.classList.contains("selected")){
                option.classList.remove("selected")
            }


            if (option.id!= "optionInicio"){

                let svgOption = option.lastElementChild.lastElementChild;

                if(containerSubmenu.classList.contains("showOptions")){
                    containerSubmenu.classList.remove("showOptions")
                }


                if (svgOption.classList.contains("open")){
                    svgOption.classList.remove("open")
                }

                if(option.parentElement.lastElementChild.firstElementChild.classList.contains("openPaddingOptions")){
                    option.parentElement.lastElementChild.firstElementChild.classList.remove("openPaddingOptions")
                }
/*
                if (containerOptions.classList.contains("selected")){
                    containerOptions.classList.remove("selected")
                }*/
            }

        })
    }
})



/*
option.addEventListener('click', () => {
    console.log(option);
})*/



