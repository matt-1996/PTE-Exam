<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnswerShortQuestion;
use Inertia\Inertia;
class AnswerShortQuestionController extends Controller
{
    public function index()
    {
        $answerShortQuestion = AnswerShortQuestion::paginate(15);

        return response()->json(['message' => $answerShortQuestion]);
    }

    public function show($id)
    {
        $answerShortQuestion = AnswerShortQuestion::findOrFail($id);

        return Inertia::render('practice/speaking/answerShortQuestion', [
            'answerShortQuestion' => $answerShortQuestion
        ]);
    }
}
