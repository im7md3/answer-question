<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function votes(){
        return $this->belongsToMany(User::class,'votes_answers','answer_id','user_id')->withPivot('score');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'commentable_id')->with('user')->where('Comment_type','answer');
    }

    public function getCreatedAtAttribute($value)
    {
        /* return date("d F Y H:i", strtotime($value)); */
        $value = new Carbon($value);  
        return $value->diffForHumans();                     
    }
}
