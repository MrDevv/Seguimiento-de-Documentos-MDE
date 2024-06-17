<?php


class UsuarioController{

    public function index(){
        require_once 'views/login/index.php';
    }

    public function login(){
        $_SESSION['autenticado'] = true;

        header('Location:'.base_url);
    }

    public function  logout(){
        $_SESSION['autenticado'] = false;
        unset($_SESSION['autenticado']);

        header('Location:'.base_url);
    }
}
