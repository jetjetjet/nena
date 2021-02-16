<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tweetcode');
            $table->string('username');
            $table->string('tweetava');
            $table->text('tweetraw');
            $table->text('tweettext');
            $table->dateTime('tweetdate');
            $table->string('tweetdecision')->nullable();
            $table->decimal('tweetscorepos')->nullable();
            $table->decimal('tweetscorenet')->nullable();
            $table->decimal('tweetscoreneg')->nullable();
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
        Schema::dropIfExists('tweets');
    }
}
