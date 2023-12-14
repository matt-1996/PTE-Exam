<?php

namespace App\Http\Controllers\Listening;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class MultipleChoiceSingleController extends Controller
{
    public function index()
    {
        $MCS = Practice::where('type', 'L_MCS')->get();

        return response()->json(['message' => $MCS],200);
    }

    public function show($id)
    {
        $MCS = Practice::find($id);

        $files = $MCS->files;

        $answers = $MCS->answers;

        return Inertia::render('practice/listening/mcs',[
            'mcs' => $MCS,
            'files' => $files,
            'answers' => $answers
        ]);

    }
}
