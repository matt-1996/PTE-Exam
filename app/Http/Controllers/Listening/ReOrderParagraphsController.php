<?php

namespace App\Http\Controllers\Listening;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Practice;
use Inertia\Inertia;
class ReOrderParagraphsController extends Controller
{
    public function index()
    {
        $ROs = Practice::where('type', 're_order_paragraph')->get();

        return response()->json(['message' => $ROs],200);
    }

    public function show($id)
    {
        $ROP = Practice::find($id);

        $paragraphs = $ROP->paragraphs;

        $answers = $ROP->paragraphs()->orderBy('answer_order', 'asc')->get();

        // dd($answer);

        // dd($paragraphs);

        // return response()->json(['rop' => $ROP, 'paragraphs' => $paragraphs]);

        return Inertia::render('practice/listening/rop',[
            'rop' => $ROP,
            'paragraphs' => $paragraphs,
            'answers' => $answers
        ]);

    }

    public function view(){
        return Inertia::render('practice/listening/ro');
    }
}
