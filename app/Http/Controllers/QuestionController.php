<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Inertia\Inertia;
class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy("created_at","desc")->paginate(10);

        return Inertia::render("question/index", ["questions" => $questions]);
    }

    public function show($id)
    {
        $question = Question::find($id);

        return response()->json(["message" => $question]);
    }
}
