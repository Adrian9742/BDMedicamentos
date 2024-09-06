<?php

    $dbHost = 'Localhost';
    $dbUser= 'root';
    $dbPass = '';
    $db = 'registro';




    $conexao = new mysqli($dbHost, $dbUser, $dbPass, $db);

    // if($conexao->connect_errno)
    // {
    //     echo "Erro";
    // }
    // else
    //{
    //    echo "Conexão efetuada com sucesso";
    // }
?>