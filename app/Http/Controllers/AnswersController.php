<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request)
    {
        $ques=Question::findOrFail($request->id);
        if(auth()->id()!==$ques->user_id){
        $answer = new Answer();
        $answer->answer = $request->answer;
        $answer->user_id = auth()->id();
        $answer->question_id = $request->id;
        $answer->save();
        return redirect()->back()->with('success', 'Answer posted successfully');
    }else{
        return redirect()->back()->with('fail', "You can't answer your question");
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnswerRequest $request, $id)
    {
        $answer=Answer::findOrFail($id);
        $this->authorize('update', $answer);
        $answer->answer=$request->answer;
        $answer->save();
        return redirect()->back()->with(['success'=>'Answer updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer=Answer::findOrFail($id);
        $this->authorize('delete', $answer);
        $answer->votes()->detach();
        $answer->delete();
        return redirect()->back()->with('success','Answer deleted successfully');
    }

    public function vote(Request $request)
    {
        if (auth()->check()) {
            auth()->user()->addVoteToAnswer($request->id,$request->score);
            $answer = Answer::with(['votes'=>function($v){
                $v->where('user_id',auth()->id())->first(['name']);
            }])->find($request->id);
            $score = $answer->votes()->get()->sum('pivot.score');
            $answer->score = $score;
            $answer->save();
            return ['answer'=>$answer];
        }
    }

}
