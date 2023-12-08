<?php

use App\Http\Controllers\AnswerShortQuestionController;
use App\Http\Controllers\ReadAloudController;
use App\Http\Controllers\RepeatSentenceController;
use App\Http\Controllers\ReTellLectureController;
use App\Http\Controllers\DescribeImageController;
use App\Models\DescribeImage;
use App\Models\AnswerShortQuestion;
use App\Http\Controllers\writing\summarizeWtittenTextController;
use App\Http\Controllers\writing\writeEssayController;

Route::get('read_alouds/{id}', [ReadAloudController::class,'show'])->name('prctice.readAloud');

Route::get('read_aloud_index' , [ReadAloudController::class,'index'])->name('practice.readAloud.Index');

Route::get('repeat_sentence/{id}', [RepeatSentenceController::class, 'show'])->name('practice.repeat.sentence.show');

Route::get('repeat_sentence_index', [RepeatSentenceController::class,'index'])->name('practice.repeatSentence.Index');

Route::get('describe_image/{id}' , [DescribeImageController::class,'show'])->name('practice.DescribeImage.show');

Route::get('describeImages' , [DescribeImageController::class,'index'])->name('practice.DescribeImage.index');

Route::get('re-tell-lecture/{id}', [ReTellLectureController::class, 'show'])->name('practice.retellLecture.show');

Route::get('re-tell-lectures', [ReTellLectureController::class, 'index'])->name('practice.retellLecture.index');

Route::get('answer-short-question/{id}', [AnswerShortQuestionController::class, 'show'])->name('practice.answerShortQuestion.show');

Route::get('answer-short-questions', [AnswerShortQuestionController::class, 'index'])->name('practice.answerShortQuestion.index');

Route::get('summariza-writen-text/{id}', [summarizeWtittenTextController::class , 'show'])->name('practice.summarizeWrittenText.show');

Route::get('summariza-writen-texts', [summarizeWtittenTextController::class , 'index'])->name('practice.summarizeWrittenText.index');

Route::get('write-essay/{id}', [writeEssayController::class, 'show'])->name('practice.writeEssays.show');

Route::get('write-essays', [writeEssayController::class, 'index'])->name('practice.writeEssays.index');
