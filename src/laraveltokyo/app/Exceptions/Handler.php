<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    // ...

    public function report(Throwable $exception)
    {
        Log::error($exception);

        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Something went wrong.',
            ], 500);
        }

        return parent::render($request, $exception);
    }
}
