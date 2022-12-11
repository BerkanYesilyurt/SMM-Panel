<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function faqPage()
    {
        return view('pages.admin.faq', [
            'faqs' => Faq::all()
        ]);
    }
}
