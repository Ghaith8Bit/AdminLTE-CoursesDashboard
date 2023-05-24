<?php

namespace App\Http\Controllers;

use App\Filters\CourseFilters;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = (new CourseFilters($request))->get();

        return view('dashboard.courses.index', [
            'courses' => $courses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCourseRequest $request)
    {
        Course::create($request->all());
        return redirect()->route('dashboard.courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('dashboard.courses.show', ['course' => $course]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());
        return redirect()->back()->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'Course deleted successfully.');
    }
}
