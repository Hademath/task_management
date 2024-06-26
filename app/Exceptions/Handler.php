<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $this->renderable(function (ValidationException $exception, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Validation Failed',
                    'errors' => $exception->errors(),
                ], 422);
            }
        });

        $this->renderable(function (NotFoundHttpException $exception, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Not Found',
                ], 404);
            }
        });

        $this->renderable(function (Throwable $exception, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Server Error',
                    'error' => $exception->getMessage(),
                ], 500);
            }
        });
    }
}
