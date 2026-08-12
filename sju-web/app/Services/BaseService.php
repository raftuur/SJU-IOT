<?php

namespace App\Services;

class BaseService
{
    /**
     * Success Response
     */
    protected function success(string $message, mixed $data = null): array
    {
        return [
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ];
    }

    /**
     * Error Response
     */
    protected function error(string $message, mixed $errors = null): array
    {
        return [
            'success' => false,
            'message' => $message,
            'errors'  => $errors,
        ];
    }
}