<?php

namespace App\Http\Controllers\Reading;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class FIBController extends Controller
{
    public function index()
    {
        $FIBs = Practice::where('type', 'R_FIB')->get();

        return response()->json(['message' => $FIBs],200);
    }

    public function show($id)
    {
        $fib = Practice::find($id);

        // dd($fib);

        // $answers = $fib->answers;

        return Inertia::render('practice/reading/fib',[
            'fib' => $fib,
            // 'answers' => $answers
        ]);

    }
}
