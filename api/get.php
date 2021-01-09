<?php

require '../config.php';

$method    = strtolower($_SERVER['REQUEST_METHOD']);
$note      = [];

if ($method === 'get')
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
            $responseArray['errors'] = 'ID inexistente!';
        }
    }
    else
    {
        $responseArray['errors']    = 'Parâmetro não enviado.';
    }
}
else
{
    $responseArray['errors']        = 'Método não permitido! Métodos permitidos: GET';
}

require '../includes/headers.php';
require '../includes/response.php';