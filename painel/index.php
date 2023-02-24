<?php

    include('class/Painel.php');
    include('../config.php');
    
    //Validando se o login já está autenticado
    if(Painel::logado() == false){ 
        include('login.php');
    }else{
        include('main.php');
    }




?>