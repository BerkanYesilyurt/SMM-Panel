<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Arr;
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

    public function createNewFaq(Request $request)
    {
        $fields = $request->validate([
            'question' => 'required|min:1|max:1000',
            'answer' => 'required|min:1|max:1000'
        ]);

        Faq::create($fields);
        return back()->with('message', 'You have successfully created a F.A.Q.');
    }

    public function deleteFaq(Request $request)
    {
        $request->validate([
            'delete_id' => 'required|numeric|exists:faq,id',
        ]);

        Faq::findOrFail($request->delete_id)->delete();

        return back()->with('message', 'You have successfully deleted the F.A.Q.');
    }
}
