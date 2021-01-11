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
    else
    {
        $responseArray['response']    = 'There is not data to show';
    }
}
else
{
    setHeader('HTTP/1.1 405 Method Not Allowed');
    $responseArray['errors'] = 'Method not allowed! Allowed methods: GET';
}

require '../includes/headers.php';
require '../includes/response.php';