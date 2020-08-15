<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container; //instaceia modelos

class AuthController extends Action {

    public function autenticar() {
        $usuario = Container::getModel('Usuario');
        $usuario->_set('email', $_POST['email']);
        $usuario->_set('senha', md5($_POST['senha']));
        
        $usuario->autenticar();
        
        if ($usuario->_get('id') != '' && $usuario->_get('nome') != '') {
            session_start();
            $_SESSION['id'] = $usuario->_get('id');
            $_SESSION['nome'] = $usuario->_get('nome');
            header('Location: /timeline');
        } else {
            header('Location: /?login=erro');
        }
    }
    public function sair(){
        session_start();
        session_destroy();
        header('Location: /');
    }

}

?>