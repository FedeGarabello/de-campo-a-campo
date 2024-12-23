<?php
namespace Src\Responder;

class ApiResponser
{
    public function successResponse($data, $code)
    {
        header('Content-Type: application/json', true, $code);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function errorResponse($message, $code)
    {
        header('Content-Type: application/json', true, $code);
        echo json_encode(['error' => $message], JSON_UNESCAPED_UNICODE);
    }
}
