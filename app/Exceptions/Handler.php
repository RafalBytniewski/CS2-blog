<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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

    public function render($request, Throwable $exception)
    {
        // Sprawdź, czy żądanie oczekuje JSON
        if ($request->expectsJson()) {
            // Jeśli wyjątek jest instancją klasy HttpException
            if (method_exists($exception, 'getStatusCode')) {
                $statusCode = $exception->getStatusCode();
            } else {
                $statusCode = 500; // Domyślny kod błędu (Internal Server Error)
            }
    
            // Zwróć odpowiedź JSON z informacjami o błędzie
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage() ?: 'Something went wrong.'
            ], $statusCode);
        }
    
        // Domyślne renderowanie błędu
        return parent::render($request, $exception);
    }


}
