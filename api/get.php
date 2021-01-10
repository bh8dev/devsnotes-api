<?php

require '../config.php';
require '../http.php';

$note      = [];

if (isGet())
{
    $id     = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id)
    {
        $sql      = 'SELECT * FROM notes WHERE id = :id';
        $query    = $pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        if ($query->rowCount() > 0)
        {
            $note = $query->fetch();

            $responseArray['response'] = [
                'id' => $note->id,
                'title' => $note->title,
                'body' => $note->body
            ];
            $responseArray['errors'] = 'none';
        }
        else
        {
            header('HTTP/1.1 400 Bad Request');
            $responseArray['errors'] = 'Invalid ID!';
        }
    }
    else
    {
        header('HTTP/1.1 400 Bad Request');
        $responseArray['errors']    = 'Parameter not sent!';
    }
}
else
{
    header('HTTP/1.1 405 Method Not Allowed');
    $responseArray['errors']        = 'Method not allowed! Allowed methods: GET';
}

require '../includes/headers.php';
require '../includes/response.php';