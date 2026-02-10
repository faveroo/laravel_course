<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            RateLimiter::for('email-generator', function (Request $request) {
                return Limit::perMinute(10)->by($request->ip());
            });
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {})
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e, $request) {

            $status = $e instanceof HttpExceptionInterface
                ? $e->getStatusCode()
                : 500;

            // 🔥 Só renderiza Inertia para requisições web
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], $status);
            }

            return Inertia::render('Error', [
                'status' => $status,
                'message' => match ($status) {
                    404 => 'Essa página não existe.',
                    403 => 'Acesso negado.',
                    500 => 'Erro interno do servidor.',
                    default => 'Algo deu errado.'
                }
            ])->toResponse($request)->setStatusCode($status);
        });
    })->create();
