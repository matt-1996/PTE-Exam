<?php

namespace App\Http\Controllers\writing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;

class writeEssayController extends Controller
{
    public function index()
    {
        $writeEssays = Practice::where('type', 'write_essay')->get();

        return response()->json(['message' => $writeEssays]);
    }

    public function show($id)
    {
        $writeEssay = Practice::find($id);

        return Inertia::render('practice/writing/writeEssay',[
            'writeEssay' => $writeEssay
        ]);
    }
}
