<?php 

$envPath = __DIR__ . '/../.env';
$env = parse_ini_file($envPath);
$host = $env['HOST'];
$base = $env['BASE']; 
$user = $env['USER'] ;
$pass = $env['PASS'];

$connM = new mysqli($host, $user, $pass, $base); 
//echo 'conexão realizada com sucesso';


if($connM->connect_error){
    die("falha na conexão: ". $connM->connect_error);
}

$connM->set_charset("utf8");

$connM->select_db("$base");