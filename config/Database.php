<?php

$env = parse_ini_file(__DIR__ . '/.env');

$host = $env['DB_HOST'];
$port = $env['DB_PORT'];
$dbname = $env['DB_NAME'];
$user = $env['DB_USER'];
$password = $env['DB_PASSWORD'];

try{
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("Erro de conexão". $e->getMessage());
}

?>