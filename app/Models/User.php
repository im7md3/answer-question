<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'address',
        'site',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class)->with('question');
    }

    public function votesQuestions(){
        return $this->belongsToMany(Question::class,'votes_questions','user_id','question_id')->withPivot('score');
    }

    public function votedForQuestion($id){
        return $this->votesQuestions()->where('Question_id',$id)->first();
    }

    public function addVoteToQuestion($id,$score){
        $vote=$this->votedForQuestion($id);
        $ques=Question::find($id);
            if ($vote) {
                if($vote->pivot->score==$score){
                    $this->votesQuestions()->detach($id,);
                }else{
                    $this->votesQuestions()->updateExistingPivot($id, ['score' =>$score]);
                }
            } else {
                $this->votesQuestions()->attach($id, ['score' =>$score]);
                if($score==1){
                    $this->rewards($ques->user_id,10);
                }
            }
    }


    public function votesAnswers(){
        return $this->belongsToMany(Answer::class,'votes_answers','user_id','answer_id')->withPivot('score');
    }

    public function votedForAnswer($id){
        return $this->votesAnswers()->where('answer_id',$id)->first();
    }

    public function addVoteToAnswer($id,$score){
        $vote=$this->votedForAnswer($id);
            if ($vote) {
                if($vote->pivot->score==$score){
                    $this->votesAnswers()->detach($id);
                }else{
                    $this->votesAnswers()->updateExistingPivot($id, ['score' =>$score]);
                }
            } else {
                $this->votesAnswers()->attach($id, ['score' =>$score]);
            }
    }

    public function badges(){
        return $this->belongsToMany(Badge::class,'badges_users');
    }
    
    public function badgeIsExist($badge){
        return $this->badges()->where('name',$badge->name)->exists();
    }

    public function addBadge($user){
        $badges=Badge::where('score', '<=' ,$user->reputation)->get();
        if($badges->count()>0){
            foreach($badges as $badge){
                if(!$user->badgeIsExist($badge)){
                    $user->badges()->attach($badge);
                }
            }
        }
    }

    public function rewards($id,$score){
            $user = User::find($id);
            $user->reputation=$user->reputation+$score;
            $user->save();
            $this->addBadge($user);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
