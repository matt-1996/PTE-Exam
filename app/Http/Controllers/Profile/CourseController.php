<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\course;

class CourseController extends Controller
{
    public function my_courses()
    {
        $courses = Course::all();
        return Inertia::render("dashboard/myCourses",[
            'courses' => $courses
        ]);
    }
}
