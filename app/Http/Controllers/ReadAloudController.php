<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
use App\Models\Bookmark;
use App\Models\User;

class ReadAloudController extends Controller
{

    public function index()
    {
        $readAlouds = Practice::where('type','read_aloud')->paginate(12);

        return response()->json(['message' => $readAlouds]);
    }
    public function show($id)
    {
        $reading = Practice::find($id);

        // dd($files);
        // $bookmarks = User::find(1);

        // foreach($bookmarks->read_alouds as $bookmark)
        // {
        //     echo($bookmark);
        // }

        // foreach($reading->bookmarks as $bookmarks)
        // {
        //     dd($bookmarks);
        // }

        return Inertia::render("practice/speaking/readAloud", ['reading' => $reading]);
    }
}
