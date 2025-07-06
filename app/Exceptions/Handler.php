<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Throwable;
use TypeError;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e) : SymfonyResponse
    {
        if ($request->expectsJson()) {
            
            if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response()->json(['error' => 'Recurso no encontrado'], 404);
            }

            if ($e instanceof TypeError) {
                return response()->json([
                                            'message' => 'El recurso enviando no es correcto, asegurese de que esta enviando lo correcto',
                                            'error'   => app()->isLocal() ? $e->getMessage() : null
                                        ], 422);
            }

            return response()->json(['message' => app()->isLocal() ? $e->getMessage() : 'Error en el servidor'], 500);
        }

        return parent::render($request, $e);
    }
}
