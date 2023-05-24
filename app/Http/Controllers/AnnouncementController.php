<?php

namespace App\Http\Controllers;

use App\Filters\AnnouncementFilters;
use App\Http\Requests\CreateAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $announcements = (new AnnouncementFilters($request))->get();

        return view('dashboard.announcements.index', [
            'announcements' => $announcements,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAnnouncementRequest $request)
    {
        Announcement::create($request->all());
        return redirect()->route('dashboard.announcements.index')->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        return view('dashboard.announcements.show', ['announcement' => $announcement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        $announcement->update($request->all());
        return redirect()->back()->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->back()->with('success', 'Announcement deleted successfully.');
    }

    /**
     * Update the is_published for the specified resource in storage.
     */
    public function publish(Announcement $announcement)
    {
        $announcement->update([
            'is_published' => $announcement->is_published ? 0 : 1,
        ]);
        return redirect()->back()->with('success', 'Announcement is published successfully.');
    }
}
