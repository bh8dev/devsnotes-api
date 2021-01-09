<?php

require '../config.php';

$method    = strtolower($_SERVER['REQUEST_METHOD']);
$notes     = [];

if ($method === 'get')
{
    $sql    = 'SELECT * FROM notes';
    $notesReturned = $pdo->query($sql);

    if ($notesReturned->rowCount() > 0)
    {
        $notes = $notesReturned->fetchAll();

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
    $responseArray['errors'] = 'Método não permitido! Métodos aceitos: GET';
}

require '../includes/headers.php';
require '../includes/response.php';