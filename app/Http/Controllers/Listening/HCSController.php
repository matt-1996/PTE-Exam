<?php

namespace App\Http\Controllers\Listening;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class HCSController extends Controller
{
    public function index()
    {
        $HCSs = Practice::where('type', 'HCS')->get();

        return response()->json(['message' => $HCSs],200);
    }

    public function show($id)
    {
        $HCS = Practice::find($id);

        $files = $HCS->files;

        $answers = $HCS->answers;

        return Inertia::render('practice/listening/hcs',[
            'hcs' => $HCS,
            'files' => $files,
            'answers' => $answers
        ]);

    }
}
