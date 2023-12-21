<?php

namespace App\Http\Controllers\Listening;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class SSTController extends Controller
{
    public function index()
    {
        $SST = Practice::where('type', 'SPT')->get();

        return response()->json(['message' => $SST],200);
    }

    public function show($id)
    {
        $SST = Practice::find($id);

        $files = $SST->files;

        return Inertia::render('practice/listening/sst',[
            'sst' => $SST,
            'files' => $files,
        ]);

    }
}
