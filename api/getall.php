<?php

require '../config.php';

$method    = strtolower($_SERVER['REQUEST_METHOD']);
$notes     = [];

if ($method === 'get')
{
    $sql    = 'SELECT * FROM notes';
    $query = $pdo->query($sql);

    if ($query->rowCount() > 0)
    {
        $notes = $query->fetchAll();

        foreach ($notes as $note)
        {
            $responseArray['response'][] = [
                'id' => $note->id,
                'title' => $note->title,
                'body' => $note->body
            ];
        }
    }
}
else
{
    $responseArray['errors'] = 'Método não permitido! Métodos permitidos: GET';
}

require '../includes/headers.php';
require '../includes/response.php';