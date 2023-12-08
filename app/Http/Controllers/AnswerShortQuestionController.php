<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class AnswerShortQuestionController extends Controller
{
    public function index()
    {
        $answerShortQuestion = Practice::where('type', 'ASQ')->paginate(15);

        return response()->json(['message' => $answerShortQuestion]);
    }

    public function show($id)
    {
        $answerShortQuestion = Practice::findOrFail($id);

        $files = $answerShortQuestion->files;

        return Inertia::render('practice/speaking/answerShortQuestion', [
            'answerShortQuestion' => $answerShortQuestion,
            'files' => $files
        ]);
    }
}
