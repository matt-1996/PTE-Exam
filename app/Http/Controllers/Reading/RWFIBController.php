<?php

namespace App\Http\Controllers\Reading;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class RWFIBController extends Controller
{
    public function index()
    {
        $FIBs = Practice::where('type', 'RW_FIB')->get();

        return response()->json(['message' => $FIBs],200);
    }

    public function show($id)
    {
        $fib = Practice::find($id);

        // dd($fib);

        // $answers = $fib->answers;

        return Inertia::render('practice/reading/rw_fib',[
            'fib' => $fib,
            // 'answers' => $answers
        ]);

    }
}
