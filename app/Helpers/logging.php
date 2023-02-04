<?php

use App\Models\ErrorLog;

function createErrorLog($request, $e){
    if($e instanceof Throwable) {
        //$e->getStatusCode()
        return ErrorLog::create([
            'user_id' => auth()->user()->id ?? NULL,
            'user_ip' => $request->ip(),
            'user_agent' => $request->header('user-agent'),
            'method' => $request->method(),
            'referer' => $request->headers->get('referer'),
            'url' => $request->fullUrl(),
            'message' => $e->getMessage(),
            'filename' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTrace(),
        ]);
    }
}

