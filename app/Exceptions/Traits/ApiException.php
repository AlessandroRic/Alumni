<?php

namespace App\Exceptions\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait ApiException {

    protected function getJsonException($request, $e) 
    {
        if($e instanceof ModelNotFoundException) {
            return $this->notFoundException();
        }
        if($e instanceof HttpException) {
            return $this->httpException($e);
        }
        return $this->genericException();
    }

    protected function notFoundException() 
    {
        return $this->getResponse(
            "Recurso não encontrado",
            "01",
            404
        );
    }

    protected function httpException($e) 
    {
        return $this->getResponse(
            "Erro de Verbo HTTP",
            "03",
            $e->getStatusCode()
        );
    }

    protected function genericException() 
    {
        return $this->getResponse(
            "Erro interno do servidor",
            "02",
            500
        );
    }

    protected function getResponse($message, $code, $status) 
    {
        return response()->json([
            "errors" => [
                [
                    "status" => $status,
                    "code" => $code,
                    "message" => $message
                ]
            ]
        ], $status);
    }
}