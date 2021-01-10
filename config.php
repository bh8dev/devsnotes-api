<?php

$databaseDsn     = 'mysql';
$databaseHost    = 'localhost';
$databaseName    = 'devsnotes';
$databaseUser    = 'root';
$databasePassword    = '';
$databaseOptions     = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
];

$responseArray = [
    'errors' => [],
    'response' => []
];

try
{
    $pdo    = new PDO("{$databaseDsn}:host={$databaseHost};dbname={$databaseName}", $databaseUser, $databasePassword, $databaseOptions);
    return $pdo;
}
catch (PDOException | Exception $exception)
{
    $responseArray['errors'] = "Database error: code {$exception->getCode()}";
    echo json_encode($responseArray, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    exit();
}