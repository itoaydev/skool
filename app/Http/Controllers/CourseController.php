<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_description' => 'required|string',
            'group_id' => 'required|exists:groups,id'
        ]);

        $course = Course::create($validatedData);

        if ($request->hasFile('course_image')) {
            $imagePath = $request->file('course_image')->store('photos', 'public');
            $course->course_image = $imagePath;
            $course->save();
        }
        return response()->json(['message' => 'Course created successfully', 'course' => $course]);
    }
    public function show(string $id)
    {
        // Find all posts where group_id is equal to $id
        $posts = Course::where('group_id', $id)->latest()->get();

        return response()->json($posts);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
