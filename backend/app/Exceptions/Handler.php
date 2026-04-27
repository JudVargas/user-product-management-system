<?php

namespace App\Exceptions;

public function render($request): \Illuminate\Http\JsonResponse
    {
        // VALIDACIÓN (422)
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $exception->errors()
            ], 422);
        }

        // NO AUTENTICADO (401)
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return response()->json([
                'success' => false,
                'message' => 'No autenticado'
            ], 401);
        }

        // NO AUTORIZADO (403)
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException 
            && $exception->getStatusCode() === 403) {
            return response()->json([
                'success' => false,
                'message' => 'Acceso no autorizado'
            ], 403);
        }

        // NO ENCONTRADO (404)
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->json([
                'success' => false,
                'message' => 'Recurso no encontrado'
            ], 404);
        }

        // ERROR GENERAL (500)
        return response()->json([
            'success' => false,
            'message' => config('app.debug')
                ? $exception->getMessage()
                : 'Error interno del servidor'
        ], 500);

        return parent::render($request, $exception);
    }