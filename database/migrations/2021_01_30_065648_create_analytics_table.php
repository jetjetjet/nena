<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('analytics', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('tweetid');
        //     $table->string('analytictext');
        //     $table->decimal('scorepositif');
        //     $table->decimal('scorenetral');
        //     $table->decimal('scorenegatif');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analytics');
    }
}
