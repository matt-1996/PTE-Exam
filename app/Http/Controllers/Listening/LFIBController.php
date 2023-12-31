<?php

namespace App\Http\Controllers\Listening;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class LFIBController extends Controller
{
    public function index()
    {
        $FIBs = Practice::where('type', 'L_FIB')->get();

        return response()->json(['message' => $FIBs],200);
    }

    public function show($id)
    {
        $fib = Practice::find($id);

        // dd($fib);

        $files = $fib->files;

        return Inertia::render('practice/listening/l_fib',[
            'fib' => $fib,
            'files' => $files
        ]);

    }
}
