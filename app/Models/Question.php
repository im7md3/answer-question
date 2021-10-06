<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function getCreatedAtAttribute($value)
    {
        /* return date("d F Y H:i", strtotime($value)); */
        $value = new Carbon($value);  
        return $value->diffForHumans();                     
    }

    public function getStatusAttribute($value)
    {
        return $value==1 ? true:false;                     
    }

    public function answers(){
        return $this->hasMany(Answer::class)->with(['user','comments'])->orderBy('created_at','DESC');
    }

    public function votes(){
        return $this->belongsToMany(User::class,'votes_questions','question_id','user_id')->withPivot('score');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'commentable_id')->with('user')->where('Comment_type','question');
    }
}
