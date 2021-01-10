<?php
 
function isMethod(string $method):bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === $method;
}
 
function isGet():bool
{
    return isMethod('GET');
}
 
function isPost():bool
{
    return isMethod('POST');
}
 
function isPut():bool
{
    return isMethod('PUT');
}
 
function isDelete():bool
{
    return isMethod('DELETE');
}
 
function isOptions():bool
{
    return isMethod('OPTIONS');
}
 
function sendResponse(array $response = [], int $statusCode = 0)
{
    http_response_code($statusCode);
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}