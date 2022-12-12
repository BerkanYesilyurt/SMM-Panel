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


    public function updateFaq(Request $request, Faq $faq)
    {
        $fields = $request->validate([
            'id' => 'required|numeric|exists:faq,id',
            'question' => 'required|min:1|max:1000',
            'answer' => 'required|min:1|max:1000'
        ]);

        $filteredFields = Arr::except($fields, ['id']);
        $faq->findOrFail($request->id)->update($filteredFields);
        return back()->with('message', 'You have successfully updated the F.A.Q.');
    }
}
