<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeVotesesAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained('users','id')->cascadeOnDelete();
            $table->unsignedBigInteger('answer_id')->constrained('answers','id')->cascadeOnDelete();
            $table->tinyInteger('score')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes_answers');
    }
}
