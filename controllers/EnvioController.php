<?php

require_once "models/Envio.php";


class EnvioController{
    private Envio $envioModel;


    public function __construct(){
        $this->envioModel = new Envio();
    }

    public function cancelarEnvio(){
        if (isset($_POST['codEnvio'])){
            $this->envioModel->setCodEnvio($_POST['codEnvio']);
            $this->envioModel->cancelarEnvio();

            $this->redirect();
        }
    }




}