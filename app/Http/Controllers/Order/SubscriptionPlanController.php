<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Inertia\Inertia;
class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $plans = Subscription::all();

        return Inertia::render('dashboard/subscriptionPlan',[
            'plans' => $plans
        ]);
    }
}
