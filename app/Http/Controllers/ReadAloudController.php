<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reading;
use Inertia\Inertia;
class ReadAloudController extends Controller
{

    public function index()
    {
        $readAlouds = Reading::paginate(2);

        return response()->json(['message' => $readAlouds]);
    }
    public function show($id)
    {
        $reading = Reading::find($id);

        return Inertia::render("practice/speaking/readAloud", ['reading' => $reading]);
    }
}
