<?php

$databaseDsn     = 'mysql';
$databaseHost    = 'localhost';
$databaseName    = 'devsnotes';
$databaseUser    = 'root';
$databasePassword    = '';
$databaseOptions     = [
    PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
];

$responseArray = [
    'error' => '',
    'response' => []
];

try
{
    $pdo    = new PDO("{$databaseDsn}:host={$databaseHost};dbname={$databaseName}", $databaseUser, $databasePassword, $databaseOptions);
    return $pdo;
}
catch (PDOException $exception)
{
    throw new Exception('Database error:', $exception->getCode());
    exit;
}