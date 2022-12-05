<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AnnouncementController extends Controller
{
    public function announcementsPage()
    {
        return view('pages.admin.announcements', [
            'announcements' => Announcement::all()
        ]);
    }

    public function updateAnnouncement(Request $request, Announcement $announcement)
    {
        $fields = $request->validate([
            'id' => 'required|numeric|exists:announcements,id',
            'title' => 'required|min:1|max:1000',
            'description' => 'required|min:1|max:1000'
        ]);

        $filteredFields = Arr::except($fields, ['id']);
        $announcement->findOrFail($request->id)->update($filteredFields);
        return back()->with('message', 'You have successfully updated the announcement.');
    }

    public function createNewAnnouncement(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|min:1|max:1000',
            'description' => 'required|min:1|max:1000'
        ]);

        Announcement::create($fields);
        return back()->with('message', 'You have successfully created an announcement.');
    }
}
