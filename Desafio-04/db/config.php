<?php

    $envPath = __DIR__ . '/../.env';
    $env = parse_ini_file($envPath);
    $host = $env['HOST'];
    $user = $env['USER'];
    $pass = $env['PASS'];
    $base = $env['BASE'];

   

    //criando conexão com mysqli
    // $connM = new mysqli($host, $user, $pass, $base);

    $connM = new mysqli($host, $user, $pass, $base);

    //echo "conexão realizada com sucesso";

    // verficando a conexão mysqli
    if ($connM->connect_error){
        die("Falha na conexão: ".$connM->connect_error);
    }

    //criando conexão com PDO
    $dsn = "mysql:host=" . $host . ";dbname=" . $base . ";charset=utf8mb4";
    $connP = new PDO($dsn, $user, $pass);

    //verificando a conexão PDO
    