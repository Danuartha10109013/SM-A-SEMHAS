<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Session\TokenMismatchException;


class Handler extends ExceptionHandler
{
    /**
     * Daftar exception yang tidak perlu dilaporkan.
     */
    protected $dontReport = [];

    /**
     * Daftar exception yang tidak perlu di-flash.
     */
    protected $dontFlash = ['password', 'password_confirmation'];

    /**
     * Render exception yang terjadi.
     */
    public function render($request, Throwable $exception)
    {
        // Menangani error 404 (Halaman Tidak Ditemukan)
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        // Menangani error umum (500 - Internal Server Error)
        if ($exception instanceof HttpException || $exception instanceof \ErrorException) {
            return response()->view('errors.500', [
                'exception' => $exception
            ], 500);
        }
        // Error 419 - CSRF token mismatch / page expired
        if ($exception instanceof TokenMismatchException) {
            return response()->view('errors.419', [], 419);
        }

        return parent::render($request, $exception);
    }
}
