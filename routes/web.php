<?php
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use App\Models\Question;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    $questions=Question::with(['user','tags'])->withCount('answers')->orderBy('created_at','DESC')->get();
        return Inertia::render('Welcome',compact('questions'));
})->name('home');


Route::resource('users',UsersController::class)->parameters([
    'users' => 'username',
]);
Route::resource('questions',QuestionsController::class)->parameters([
    'questions' => 'slug',
]);
Route::put('update_status/{id}',[QuestionsController::class,'updateStatus'])->name('update_status');
Route::post('best_answer',[QuestionsController::class,'bestAnswer'])->name('best_answer');
Route::post('vote_question',[QuestionsController::class,'vote'])->name('vote_question');

Route::resource('answers',AnswersController::class);
Route::post('vote_answer',[AnswersController::class,'vote'])->name('vote_answer');


Route::resource('tags', TagsController::class)->parameters([
    'tags' => 'slug',
]);

Route::resource('comments', CommentsController::class);

