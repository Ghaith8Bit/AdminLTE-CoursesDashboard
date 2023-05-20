<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        if (auth()->user()->role->id === 2) {
            $data = [
                'adminCount' => User::countAdmins(),
                'userCount' => User::countUsers(),
                'courseCount' => Course::count(),
                'announcementCount' => Announcement::count(),
                'activeAnnouncementCount' => Announcement::countActiveAnnouncement()
            ];
        } elseif (auth()->user()->role->id === 1) {
            $data = [
                'latestAnnouncements' => Announcement::latestAnnouncements(),
            ];
        }
        return view('dashboard.home', $data);
    }
}
