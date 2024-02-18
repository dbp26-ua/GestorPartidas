<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boardgame_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('boardgame_id');
            $table->unsignedBiginteger('user_id');
            $table->timestamps();

            $table->foreign('boardgame_id')->references('id')->on('boardgames')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_boardgame');
    }
};
