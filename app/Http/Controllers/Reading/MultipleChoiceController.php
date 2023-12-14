<?php

namespace App\Http\Controllers\Reading;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class MultipleChoiceController extends Controller
{
    public function index()
    {
        $MCM = Practice::where('type', 'reading_multiple_choice')->get();

        return response()->json(['message' => $MCM],200);
    }

    public function show($id)
    {
        $MCM = Practice::find($id);

        $answers = $MCM->answers;

        return Inertia::render('practice/reading/mcm',[
            'mcm' => $MCM,
            'answers' => $answers
        ]);

    }
}
