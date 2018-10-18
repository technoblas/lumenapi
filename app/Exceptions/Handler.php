<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // you can madafaka catch custom ex here
        
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'message' => 'Endpoint not found',
                'error' => 'Sorry, the endpoint you are looking for could not be found',
            ], 404);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'message' => 'Resource not found',
                'error' => $exception->getMessage(),
            ], 404);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => $exception->getMessage(),
                'errors' => $exception->validator->errors(),
            ], 422);
        }

        return parent::render($request, $exception);
    }
}
