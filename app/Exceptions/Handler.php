<?php

namespace App\Exceptions;

use ArgumentCountError;
use BadMethodCallException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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


    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Resource not found',
                    'errors' => 'Resource not found',
                    'statusCode' => 404,
                ], 404);
            }
        }


        if ($e instanceof AuthenticationException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized',
                    'errors' => 'Unauthorized',
                    'statusCode' => 401,
                ], 401);
            }
        }

        if ($e instanceof ModelNotFoundException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Resource not found',
                    'errors' => 'Resource not found',
                    'statusCode' => 404,
                ], 404);
            }
        }

        if ($e instanceof HttpException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                    'errors' => $e->getMessage(),
                    'statusCode' => $e->getStatusCode(),
                ], $e->getStatusCode());
            }


        }


        if ($e instanceof BadMethodCallException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                    'errors' => $e->getMessage(),
                    'statusCode' => 500,
                ], 500);
            }

        }

        if ($e instanceof ArgumentCountError) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                    'errors' => $e->getMessage(),
                    'statusCode' => 500,
                ], 500);
            }
        }

        if ($e instanceof TypeError) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                    'errors' => $e->getMessage(),
                    'statusCode' => 500,
                ], 500);
            }
        }

        if ($e instanceof BindingResolutionException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                    'errors' => $e->getMessage(),
                    'statusCode' => 500,
                ], 500);
            }
        }

        if ($e instanceof InvalidArgumentException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                    'errors' => $e->getMessage(),
                    'statusCode' => 500,
                ], 500);
            }
        }
    }

    }
