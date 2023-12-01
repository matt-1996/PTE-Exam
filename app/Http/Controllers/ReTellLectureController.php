<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RetellLecture;
use Inertia\Inertia;
class ReTellLectureController extends Controller
{
    public function index()
    {
        $reTellLecture = ReTellLecture::paginate(15);

        return response()->json(['message' => $reTellLecture]);
    }

    public function show($id)
    {
        $retellLecture = RetellLecture::find($id);

        return Inertia::render("practice/speaking/reTellLecture", [
            "retellLecture"=> $retellLecture
        ]);
    }
}
