<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepeatSentence;
use Inertia\Inertia;
use App\Models\Practice;
class RepeatSentenceController extends Controller
{

    public function index()
    {
        $repeatSentences = Practice::where('type','repeat_sentence')->paginate(12);

        return response()->json(['message' => $repeatSentences]);
    }
    public function show($id)
    {
        $repeatSentence = Practice::find($id);

        $files = $repeatSentence->files;

        // foreach($files as $file)
        // {
        //     echo $file;
        // }

        return Inertia::render("practice/speaking/repeatSentence", ['repeatSentence' => $repeatSentence, 'files' => $files]);
    }
}
