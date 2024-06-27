<?php

class ModalsController{

    function cerrarModal(){
        $_SESSION["registro"] = "pendiente";
    }
}