<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained('users','id')->cascadeOnDelete();
            $table->unsignedBigInteger('badge_id')->constrained('badges','id')->cascadeOnDelete();
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
        Schema::dropIfExists('badges_users');
    }
}
