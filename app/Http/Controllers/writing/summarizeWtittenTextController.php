<?php

namespace App\Http\Controllers\writing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class summarizeWtittenTextController extends Controller
{
    public function index()
    {
        $SWTs = Practice::where('type','SWT')->get();

        return response()->json(['message' => $SWTs]);
    }

    public function show($id)
    {
        $SWT = Practice::find($id);

        return Inertia::render('practice/writing/summarizeWrittenText',[
            'summarizeWrittenText' => $SWT
        ]);
    }
}
