<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function search(Request $request){
        $search=$request->search;
        if($search !=""){
        $users=User::where('username','LIKE','%'.$request->search.'%')->limit(5)->get();
        $questions=Question::where('title','LIKE','%'.$request->search.'%')->limit(5)->get();
        return ['users'=>$users,'questions'=>$questions];
    }else{
        return;
    }
        
    }
}
