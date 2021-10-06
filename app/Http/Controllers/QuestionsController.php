<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionsRequest;
use App\Models\Answer;
use App\Models\Badge;
use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Inertia\Inertia;
use Illuminate\Support\Str;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        
    }

    public function index()
    {
        $questions = Question::with(['user', 'tags'])->withCount('answers')->orderBy('created_at', 'DESC')->get();
        return Inertia::render('Questions/Index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return Inertia::render('Questions/Create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request)
    {
        try {
            $ques = new Question();
            $ques->user_id = auth()->id();
            $ques->title = $request->title;
            $ques->slug = Str::slug($request->title);
            $ques->body = $request->body;
            $ques->save();
            $ques->tags()->sync($request->tags);
            auth()->user()->rewards($ques->user_id,20);
            return redirect()->route('questions.show', $ques->slug)->with('success', 'Question posted successfully');
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $theQues = Question::with(['votes' => function ($v) {
            $v->where('user_id', auth()->id())->first(['name']);
        }, 'comments', 'user', 'tags', 'answers' => function ($q) {
            $q->with(['votes' => function ($v) {
                $v->where('user_id', auth()->id())->get(['name']);
            }]);
        }])->whereSlug($slug)->first();
        
        if (!Cookie::has('uniqueId')) {
            $uniqueId  = Str::uuid();
            Cookie::queue('uniqueId', $uniqueId,1440);
            $theQues->views=$theQues->views+1;
            $theQues->save();
        }
        return Inertia::render('Questions/View', compact(['theQues']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $myQues = Question::with('tags')->whereSlug($slug)->first();
        $this->authorize('update', $myQues);
        $tags = Tag::all();
        return Inertia::render('Questions/Edit', compact('myQues', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $request, $slug)
    {
        $ques = Question::whereSlug($slug)->first();
        $this->authorize('update', $ques);
        $ques->title = $request->title;
        $ques->slug = Str::slug($request->title);
        $ques->body = $request->body;
        $ques->save();
        $ques->tags()->sync($request->tags);
        return redirect()->route('questions.show', $ques->slug)->with('success', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $ques = Question::whereSlug($slug)->first();
        $this->authorize('delete', $ques);
        $ques->votes()->detach();
        $ques->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $ques = Question::findOrFail($id);
        $ques->status = $request->status;
        $ques->save();
        return redirect()->back();
    }

    public function bestAnswer(Request $request){
        $answer=Answer::findOrFail($request->id);
        $ques=Question::findOrFail($answer->question_id);
        $ques->best_answer=$ques->best_answer===null ? $request->id : ($ques->best_answer===$request->id ? null : $request->id);
        $ques->save();
        return redirect()->back()->with('success','The correct answer has been selected successfully');
    }

    public function vote(Request $request)
    {
        if (auth()->check()) {
            $ques = Question::findOrFail($request->id);
            if($ques->user_id!==auth()->id()){
            auth()->user()->addVoteToQuestion($request->id, $request->score);
            $ques = Question::with(['votes' => function ($v) {
                $v->where('user_id', auth()->id())->first(['name']);
            }])->find($request->id);
            $score = $ques->votes()->get()->sum('pivot.score');
            $ques->score = $score;
            $ques->save();
            return $ques;
        }else{
            return  'You cannot vote for your question';
        }
        }
    }
}
