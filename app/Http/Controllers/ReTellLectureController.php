<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RetellLecture;
use Inertia\Inertia;
use App\Models\Practice;
class ReTellLectureController extends Controller
{
    public function index()
    {
        $reTellLecture = Practice::where('type', 're_tell_lecture')->paginate(15);

        return response()->json(['message' => $reTellLecture]);
    }

    public function show($id)
    {
        $retellLecture = Practice::find($id);

        $files = $retellLecture->files;

        return Inertia::render("practice/speaking/reTellLecture", [
            "retellLecture"=> $retellLecture,
            'files' => $files
        ]);
    }
}
