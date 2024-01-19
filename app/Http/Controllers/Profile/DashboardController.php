<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return inertia::render("dashboard/index");
    }

    public function contactUsView()
    {
        return Inertia::render("dashboard/contactUs");
    }

    public function settingsView()
    {
        return Inertia::render("dashboard/settings");
        
    }
}
