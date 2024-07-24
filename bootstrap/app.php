<?php

use App\Exceptions\ApiException;
use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => Authenticate::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {


        $exceptions->render(function (Throwable $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {

                $error_code = $code = ApiException::INTERNAL_ERROR;
                $reason = $e->getMessage();
                $message = ApiException::getErrorMessage($error_code);

                if ($e instanceof ApiException) {
                    $code = $e->getCode();
                    $error_code = $e->getErrorCode();
                    $reason = $e->getReason();
                    $message = ApiException::getErrorMessage($error_code);
                }
                if ($e instanceof ModelNotFoundException) {
                    $code = $error_code = 404;
                    $reason = 'Resource not found';
                    $message = ApiException::getErrorMessage($code);
                }
                if ($e instanceof ThrottleRequestsException) {
                    $code = $error_code = $e->getStatusCode();
                    $reason = 'Request was blocked';
                    $message = ApiException::getErrorMessage($code);
                }
                if ($e instanceof NotFoundHttpException) {
                    $error_code = $code = $e->getStatusCode();
                    $reason = 'Endpoint not found';
                    $message = ApiException::getErrorMessage($code);
                }
                if ($e instanceof MethodNotAllowedHttpException) {
                    $error_code = $code = $e->getStatusCode();
                    $reason = 'Method not allowed';
                    $message = ApiException::getErrorMessage($code);
                }
//                if ($e instanceof ValidatorException) {
//                    $code = $e->getCode();
//                    $error_code = $e->getErrorCode();
//                    $reason = $e->getReason();
//                    $message = ApiException::getErrorMessage($error_code);
//                    $other = $e->getErrors();
//                }

                $context = [
                    'success' => false,
                    'error' => [
                        'code' => $error_code,
                        'message' => $message,
                        'reason' => $reason,
                    ],
                ];

                if (isset($other)) {
                    $context += $other;
                }

                return response()->json($context, $code);

            }
        });


    })->create();
