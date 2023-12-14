<?php

namespace App\Http\Controllers\Listening;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class SMWController extends Controller
{
    public function index()
    {
        $SMW = Practice::where('type', 'SMW')->get();

        return response()->json(['message' => $SMW],200);
    }

    public function show($id)
    {
        $SMW = Practice::find($id);

        $files = $SMW->files;

        $answers = $SMW->answers;

        return Inertia::render('practice/listening/smw',[
            'smw' => $SMW,
            'files' => $files,
            'answers' => $answers
        ]);

    }
}
