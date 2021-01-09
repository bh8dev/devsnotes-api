<?php

require '../config.php';

$method    = strtolower($_SERVER['REQUEST_METHOD']);
$id    = 0;

if ($method === 'post')
{
    $title    = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $body     = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);

    if ($title && $body)
    {
        $sql      = 'INSERT INTO notes (title, body) VALUES (:title, :body)';
        $query    = $pdo->prepare($sql);
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':body', $body, PDO::PARAM_STR);
        $query->execute();

        $id    = $pdo->lastInsertId();

        $responseArray['response'] = [
            'id' => $id,
            'title' => $title,
            'body' => $body
        ];
    }
    else
    {
        $responseArray['errors']    = 'Campos não enviados!';
    }
}
else
{
    header('HTTP/1.1 405 Method Not Allowed');
    $responseArray['errors']        = 'Método não permitido! Métodos permitidos: POST';
}

require '../includes/headers.php';
require '../includes/response.php';