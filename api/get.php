<?php

require '../config.php';
require '../http.php';

$method    = strtolower($_SERVER['REQUEST_METHOD']);
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
        }
        else
        {
            header('HTTP/1.1 400 Bad Request');
            $responseArray['errors'] = 'ID inexistente!';
        }
    }
    else
    {
        header('HTTP/1.1 400 Bad Request');
        $responseArray['errors']    = 'Parâmetro não enviado!';
    }
}
else
{
    header('HTTP/1.1 405 Method Not Allowed');
    $responseArray['errors']        = 'Método não permitido! Métodos permitidos: GET';
}

require '../includes/headers.php';
require '../includes/response.php';