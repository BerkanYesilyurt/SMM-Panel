<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{

    public function faqPage(Faq $faq){
        $faqs = $faq::all();
        return view('pages.faq', compact('faqs'));
    }

    public function createFaq(){

    }

}
