<?php

require '../config.php';
require '../http.php';

$input    = [];

if (isOptions())
{
    sendResponse(['errors' => 'none'], 200);
}

if (isDelete())
{
    parse_str(file_get_contents('php://input'), $input);

    $id    = $input['id'] ?? 0;
    $id    = filter_var($id, FILTER_VALIDATE_INT);

    if ($id)
    {
        $sql      = 'SELECT id FROM notes WHERE id = :id';
        $verifyIfNoteExists    = $pdo->prepare($sql);

        $verifyIfNoteExists->bindValue(':id', $id, PDO::PARAM_INT);
        $verifyIfNoteExists->execute();

        if ($verifyIfNoteExists->rowCount() > 0)
        {
            $sql    = 'DELETE FROM notes WHERE id = :id';
            $deleteNote    = $pdo->prepare($sql);

            $deleteNote->bindValue(':id', $id, PDO::PARAM_INT);
            $deleteNote->execute();

            $responseArray['response']    = 'Note deleted';
        }
        else
        {
            setHeader('HTTP/1.1 400 Bad Request');
            $responseArray['errors']    = 'Invalid ID!';
        }
    }
    else
    {
        setHeader('HTTP/1.1 400 Bad Request');
        $responseArray['errors']    = 'ID not sent!';
    }
}
else
{
    setHeader('HTTP/1.1 405 Method Not Allowed');
    $responseArray['errors']    = 'Method not allowed! Allowed methods: DELETE';
}

require '../includes/headers.php';
require '../includes/response.php';