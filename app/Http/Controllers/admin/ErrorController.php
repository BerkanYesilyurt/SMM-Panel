<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ErrorLog;

class ErrorController extends Controller
{
    public function errorLogsPage()
    {
        return view('pages.admin.errors', [
            'errors' => ErrorLog::orderBy('created_at')->paginate(50)
        ]);
    }
}
