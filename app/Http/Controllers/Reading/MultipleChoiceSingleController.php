<?php

namespace App\Http\Controllers\Reading;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class MultipleChoiceSingleController extends Controller
{
    public function index()
    {
        $MCS = Practice::where('type', 'mcs')->get();

        return response()->json(['message' => $MCS],200);
    }

    public function show($id)
    {
        $MCS = Practice::find($id);

        $answers = $MCS->answers;

        return Inertia::render('practice/reading/mcs',[
            'mcs' => $MCS,
            'answers' => $answers
        ]);

    }
}
