<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Inertia\Inertia;
class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();

        return Inertia::render("dashboard/faq", [
            "faqs"=> $faqs
        ]);
    }
}
