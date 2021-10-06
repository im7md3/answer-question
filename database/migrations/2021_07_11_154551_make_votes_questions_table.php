<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeVotesQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained('users','id')->cascadeOnDelete();
            $table->unsignedBigInteger('question_id')->constrained('questions','id')->cascadeOnDelete();
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
        Schema::dropIfExists('votes_questions');
    }
}
