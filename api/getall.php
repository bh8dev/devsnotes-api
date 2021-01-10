<?php

require '../config.php';
require '../http.php';

$notes     = [];

if (isGet())
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
    header('HTTP/1.1 405 Method Not Allowed');
    $responseArray['errors'] = 'Método não permitido! Métodos permitidos: GET';
}

require '../includes/headers.php';
require '../includes/response.php';