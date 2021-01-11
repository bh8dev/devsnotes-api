<?php

require '../config.php';
require '../http.php';

if (isPost())
{
    $id       = $id ?? 0;
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
        setHeader('HTTP/1.1 400 Bad Request');
        $responseArray['errors']    = 'Fields not sent!';
    }
}
else
{
    setHeader('HTTP/1.1 405 Method Not Allowed');
    $responseArray['errors']        = 'Method not allowed! Allowed methods: POST';
}

require '../includes/headers.php';
require '../includes/response.php';