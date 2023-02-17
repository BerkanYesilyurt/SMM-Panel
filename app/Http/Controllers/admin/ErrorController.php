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

    public function errorDetailsPage(ErrorLog $error)
    {
        return view('pages.admin.error', [
            'error' => $error->load('user')
        ]);
    }

    public function deleteErrorLogs()
    {
        ErrorLog::truncate();
        return back()->with('message', 'You have successfully deleted all error logs.');
    }
}
