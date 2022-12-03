<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function announcementsPage()
    {
        return view('pages.admin.announcements', [
            'announcements' => Announcement::all()
        ]);
    }
}
