<?php

namespace App\Http\Controllers\Listening;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class WFDController extends Controller
{
    public function index()
    {
        $WFD = Practice::where('type', 'WFD')->get();

        return response()->json(['message' => $WFD],200);
    }

    public function show($id)
    {
        $WFD = Practice::find($id);

        $files = $WFD->files;

        return Inertia::render('practice/listening/wfd',[
            'wfd' => $WFD,
            'files' => $files,
        ]);

    }
}
