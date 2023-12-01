<?php

use App\Http\Controllers\QuestionController;

Route::get("/", [QuestionController::class,"index"])->name("index");

Route::get('/{id}', [QuestionController::class,'show'])->name('question.show');
