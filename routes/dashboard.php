<?php 
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Order\SubscriptionPlanController;
use App\Http\Controllers\Profile\CourseController;
use App\Http\Controllers\Profile\DashboardController;

Route::get("home", [DashboardController::class , 'index'])->name("dashboard.home");

Route::get("my-courses", [CourseController::class , 'my_courses'])->name("dashboard.my-cources");

Route::get('subscription-plans' , [SubscriptionPlanController::class ,'index'])->name('dashboard.vip-center');

Route::get('faq', [FaqController::class , 'index'])->name('dashboard.faq');

Route::get('contact-us', [DashboardController::class ,'contactUsView'])->name('dashboard.contact-us');

Route::get('settings', [DashboardController::class ,'settingsView'])->name('dashboard.settings.view');