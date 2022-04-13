<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class APIController extends Controller
{
    protected function success($data = null, int $statusCode = Response::HTTP_OK)
    {
        return response()
            ->json(
                [
                    'success'   => true,
                    'result'    => $data
                ],
                $statusCode
            );
    }
    
    protected function error(int $statusCode, string $message, array $errors = [])
    {
        return response()
            ->json(
                [
                    'success'   => false,
                    'message'   => $message,
                    'errors'    => $errors,
                ],
                $statusCode
            );
    }
}