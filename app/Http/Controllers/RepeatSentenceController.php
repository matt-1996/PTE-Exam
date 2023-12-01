<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepeatSentence;
use Inertia\Inertia;
class RepeatSentenceController extends Controller
{

    public function index()
    {
        $repeatSentences = RepeatSentence::paginate(2);

        return response()->json(['message' => $repeatSentences]);
    }
    public function show($id)
    {
        $repeatSentence = RepeatSentence::find($id);

        return Inertia::render("practice/speaking/repeatSentence", ['repeatSentence' => $repeatSentence]);
    }
}
