<?php

use App\Models\ErrorLog;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

function createErrorLog($request, $e){
    if($e instanceof Throwable) {
        return ErrorLog::create([
            'user_id' => auth()->user()->id ?? NULL,
            'user_ip' => $request->ip(),
            'user_agent' => $request->header('user-agent'),
            'method' => $request->method(),
            'referer' => $request->headers->get('referer'),
            'url' => $request->fullUrl(),
            'status_code' => $e instanceof HttpExceptionInterface ? $e->getStatusCode() : NULL,
            'message' => $e->getMessage(),
            'filename' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTrace(),
        ]);
    }
}

