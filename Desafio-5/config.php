<?php
    define('HOST', 'localhost');
    define('USER', 'nezha');
    define('PASS', 'nezh@dmin0910');
    define('BASE', 'db_cnh_social');
    
    /*$host = getenv(HOST);
    $user = getenv(USER);
    $pass = getenv(PASS);
    $base = getenv(BASE);*/

    //criando conexão com mysqli
    // $connM = new mysqli($host, $user, $pass, $base);

    $connM = new mysqli(HOST, USER, PASS, BASE);

    //echo "conexão realizada com sucesso";

    // verficando a conexão mysqli
    if ($connM->connect_error){
        die("Falha na conexão: ".$connM->connect_error);
    }

    //criando conexão com PDO
    $dsn = "mysql:host=" . HOST . ";dbname=" . BASE . ";charset=utf8mb4";
    $connP = new PDO($dsn, USER, PASS);

    //verificando a conexão PDO
    