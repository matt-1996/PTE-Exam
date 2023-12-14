<?php

namespace App\Http\Controllers\Listening;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class MultipleChoiceController extends Controller
{
    public function index()
    {
        $MCM = Practice::where('type', 'LMC')->get();

        return response()->json(['message' => $MCM],200);
    }

    public function show($id)
    {
        $MCM = Practice::find($id);

        $files = $MCM->files;

        $answers = $MCM->answers;

        return Inertia::render('practice/listening/mcm',[
            'mcm' => $MCM,
            'files' => $files,
            'answers' => $answers
        ]);

    }
}
