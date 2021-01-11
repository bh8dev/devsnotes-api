<?php

require '../config.php';
require '../http.php';

$input     = [];

if (isOptions())
{
    sendResponse(['errors' => 'none'], 200);
}

if (isPut())
{
    parse_str(file_get_contents('php://input'), $input);

    $id       = $input['id'] ?? 0;
    $title    = $input['title'] ?? null;
    $body     = $input['body'] ?? null;

    $id       = filter_var($id, FILTER_VALIDATE_INT);
    $title    = filter_var($title, FILTER_SANITIZE_STRING);
    $body     = filter_var($body, FILTER_SANITIZE_STRING);

    if ($id && $title && $body)
    {
        $sql      = 'SELECT * FROM notes WHERE id = :id';
        $verifyIfNoteExists    = $pdo->prepare($sql);

        $verifyIfNoteExists->bindValue(':id', $id, PDO::PARAM_INT);
        $verifyIfNoteExists->execute();

        if ($verifyIfNoteExists->rowCount() > 0)
        {
            $sql    = 'UPDATE notes SET title = :title, body = :body WHERE id = :id';
            $updateNote    = $pdo->prepare($sql);

            $updateNote->bindValue(':id', $id, PDO::PARAM_INT);
            $updateNote->bindValue(':title', $title, PDO::PARAM_STR);
            $updateNote->bindValue(':body', $body, PDO::PARAM_STR);
            $updateNote->execute();

            $responseArray['response'] = [
                'id' => $id,
                'title' => $title,
                'body' => $body
            ];
        }
        else
        {
            setHeader('HTTP/1.1 400 Bad Request');
            $responseArray['errors'] = 'Invalid ID!';
        }
    }
    else
    {
        setHeader('HTTP/1.1 400 Bad Request');
        $responseArray['errors']    = 'Fields not sent!';
    }
}
else
{
    setHeader('HTTP/1.1 405 Method Not Allowed');
    $responseArray['errors']        = 'Method not allowed! Allowed methods: PUT';
}

require '../includes/headers.php';
require '../includes/response.php';