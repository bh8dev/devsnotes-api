<?php
 
function isMethod(string $method)
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === $method;
}
 
function isGet()
{
    return isMethod('GET');
}
 
function isPost()
{
    return isMethod('POST');
}
 
function isPut()
{
    return isMethod('PUT');
}
 
function isDelete()
{
    return isMethod('DELETE');
}
 
function isOptions()
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