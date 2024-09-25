<?php

require_once 'config.php';

try
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

    $conexao = new PDO($dsn, DB_USER, DB_PASSWORD);

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}