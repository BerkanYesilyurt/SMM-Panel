<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public static function announcements(){
        $announcement = new Announcement();
        $announcements = $announcement->all();
        $announcementArray = [];
        foreach($announcements as $announcement){
            $announcementArray[$announcement->title] = $announcement->description;
        }

        return $announcementArray;
    }
}
