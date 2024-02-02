<?php

use App\Http\Controllers\AnswerShortQuestionController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ReadAloudController;
use App\Http\Controllers\Listening\LFIBController;
use App\Http\Controllers\Reading\RFIBController;
use App\Http\Controllers\RepeatSentenceController;
use App\Http\Controllers\ReTellLectureController;
use App\Http\Controllers\DescribeImageController;
use App\Http\Controllers\Listening\HCSController;
use App\Http\Controllers\Reading\MultipleChoiceController;
use App\Http\Controllers\Reading\MultipleChoiceSingleController;
use App\Models\DescribeImage;
use App\Models\AnswerShortQuestion;
use App\Http\Controllers\writing\summarizeWtittenTextController;
use App\Http\Controllers\writing\writeEssayController;
use App\Http\Controllers\Listening\MultipleChoiceController as l_mcm;
use App\Http\Controllers\Listening\MultipleChoiceSingleController as l_mcs;
use App\Http\Controllers\Listening\ReOrderParagraphsController;
use App\Http\Controllers\Listening\SMWController;
use App\Http\Controllers\Listening\SSTController;
use App\Http\Controllers\Listening\WFDController;
use App\Http\Controllers\Reading\RWFIBController;
use Inertia\Inertia;
use Spatie\ResponseCache\Middlewares\CacheResponse;


Route::group(['middleware' => ['auth',CacheResponse::class]], function () {
    Route::post("add-to-bookmark/{id}/{color}", [BookmarkController::class, 'create'])->name('bookmark.add');
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

Route::get('r_mcm', [MultipleChoiceController::class, 'index'])->name('practice.r_mcm.index');

Route::get('r_mcm/{id}', [MultipleChoiceController::class, 'show'])->name('practice.r_mcm.show');

Route::get('r_mcs', [MultipleChoiceSingleController::class, 'index'])->name('practice.r_mcs.index');

Route::get('r_mcs/{id}', [MultipleChoiceSingleController::class, 'show'])->name('practice.r_mcs.show');

Route::get('l_mcm', [l_mcm::class, 'index'])->name('practice.l_mcm.index');

Route::get('rw_fib', [RWFIBController::class, 'index'])->name('practice.rw_fib.index');

Route::get('rw_fib/{id}', [RWFIBController::class, 'show'])->name('practice.rw_fib.show');

Route::get('l_mcm/{id}', [l_mcm::class, 'show'])->name('practice.l_mcm.show');

Route::get('l_mcs', [l_mcs::class, 'index'])->name('practice.l_mcs.index');

Route::get('l_mcs/{id}', [l_mcs::class, 'show'])->name('practice.l_mcs.show');

Route::get('l_smw', [SMWController::class, 'index'])->name('practice.l_smw.index');

Route::get('l_smw/{id}', [SMWController::class, 'show'])->name('practice.l_smw.show');

Route::get('l_sst', [SSTController::class, 'index'])->name('practice.l_sst.index');

Route::get('l_sst/{id}', [SSTController::class, 'show'])->name('practice.l_sst.show');

Route::get('l_wfd', [WFDController::class, 'index'])->name('practice.l_wfd.index');

Route::get('l_wfd/{id}', [WFDController::class, 'show'])->name('practice.l_wfd.show');

Route::get('l_ro', [ReOrderParagraphsController::class, 'index'])->name('practice.l_rop.index');

Route::get('l_ro/{id}', [ReOrderParagraphsController::class, 'show'])->name('practice.l_rop.show');

Route::get('l_hcs', [HCSController::class, 'index'])->name('practice.l_hcs.index');

Route::get('l_hcs/{id}', [HCSController::class, 'show'])->name('practice.l_hcs.show');

Route::get('r_fib', [RFIBController::class, 'index'])->name('practice.r_fib.index');

Route::get('r_fib/{id}', [RFIBController::class, 'show'])->name('practice.r_fib.show');

Route::get('l_fib', [LFIBController::class, 'index'])->name('practice.l_fib.index');

Route::get('l_fib/{id}', [LFIBController::class, 'show'])->name('practice.l_fib.show');



});



Route::get('hiw_t', function(){
    return Inertia::render('api/listening/hiw');
});

Route::get('fib_test' , function(){
    return Inertia::render('fibPage');
});
Route::get('drag', function(){

    return Inertia::render('drag');

});
